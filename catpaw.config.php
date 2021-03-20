<?php

use net\razshare\catpaw\attributes\http\ResponseHeaders;
use net\razshare\catpaw\attributes\Request;
use net\razshare\catpaw\config\MainConfiguration;
use net\razshare\catpaw\misc\AttributeLoader;
use net\razshare\catpaw\tools\helpers\Factory as HelpersFactory;
use net\razshare\catpaw\tools\helpers\Route;
use net\razshare\catpaw\tools\helpers\SimpleQueryBuilder;
use net\razshare\catpaw\tools\Mime;
use net\razshare\catpaw\tools\Status;
use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;

return fn()=> new class() extends MainConfiguration{
    public function __construct() {
        $this->uri = '0.0.0.0:8080';
        $this->show_exception = true;
        $this->show_stack_trace = true;
        $this->webroot = __DIR__.'/public';
        $this->init('app');
    }

    private function init(string $namespace = ""):void{
        HelpersFactory::setObject(MainConfiguration::class,$this);
        HelpersFactory::setObject(LoopInterface::class,Factory::create());

        if(is_file('./.login/database.php')){
            $login = require_once './.login/database.php';
            HelpersFactory::setConstructorInjector(
                SimpleQueryBuilder::class,
                fn()=>[
                    new PDO(
                        "{$login['driver']}:dbname={$login['dbname']};host={$login['host']}",
                        $login['username'],
                        $login['password']
                    ), //provide database login
                    HelpersFactory::make(LoopInterface::class) //provide main loop
                ]
            );
        }

        (new AttributeLoader())->setLocation(__DIR__)->load($namespace);


        chdir('./src');


        Route::notFound(function(
            #[Status] Status $status,
            #[ResponseHeaders] array &$headers,
            #[Request] ServerRequestInterface $request
        ) {
            $uri = $this->webroot.$request->getUri()->getPath();
            if(\is_dir($uri)){
                if(str_ends_with($uri,'/'))
                    $uri .= 'index.html';
                else
                    $uri .= '/index.html';
            }

            if(is_file($uri) && !\strpos($uri,'../')){
                $headers["Content-Type"] = Mime::resolveContentType($uri)??'text/plain';
                $status->setCode(Status::OK);
                return file_get_contents($uri);
            }
            $status->setCode(Status::NOT_FOUND);
            $headers["Content-Type"] = "text/html";
            return '';
        });

        if(is_file('./main.php'))
            require_once './main.php';
    }
};