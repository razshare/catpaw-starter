<?php
use com\github\tncrazvan\catpaw\attributes\http\Headers;
use com\github\tncrazvan\catpaw\attributes\Singleton;
use com\github\tncrazvan\catpaw\config\MainConfiguration;
use com\github\tncrazvan\catpaw\misc\AttributeLoader;
use com\github\tncrazvan\catpaw\tools\helpers\Factory as HelpersFactory;
use com\github\tncrazvan\catpaw\tools\helpers\Route;
use com\github\tncrazvan\catpaw\tools\Mime;
use com\github\tncrazvan\catpaw\tools\Status;
use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;

HelpersFactory::setObject(LoopInterface::class,Factory::create());

$login = require_once './.login/database.php';

HelpersFactory::setConstructorInjector(
    SimpleQueryBuilder::class,
    fn()=>[
        new \PDO(
            "{$login['driver']}:dbname={$login['dbname']};host={$login['host']}",
            $login['username'],
            $login['password']
        ), //provide database login
        HelpersFactory::make(LoopInterface::class) //provide main loop
    ]
);


(new AttributeLoader())->setLocation(__DIR__)->load();


$webroot = __DIR__.'/public';

chdir('./src');


Route::notFound(function(
    #[Status] Status $status,
    #[Headers] array &$headers,
    ServerRequestInterface $request
) use(&$webroot){
    $uri = $webroot.$request->getUri()->getPath();
    if(\is_dir($uri)){
        if(str_ends_with($uri,'/'))
            $uri .= 'index.html';
        else
            $uri .= '/index.html';
    }

    if(\is_file($uri) && !\strpos($uri,'../')){
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

return new class extends MainConfiguration{
    public function __construct() {
        $this->uri = '127.0.0.1:8080';
        $this->show_exception = true;
        $this->show_stack_trace = true;
    }
};