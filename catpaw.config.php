<?php

use Amp\Http\Server\Request;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Monolog\Logger;
use net\razshare\catpaw\attributes\http\ResponseHeaders;
use net\razshare\catpaw\config\MainConfiguration;
use net\razshare\catpaw\misc\AttributeLoader;
use net\razshare\catpaw\tools\helpers\Factory;
use net\razshare\catpaw\tools\helpers\Route;
use net\razshare\catpaw\tools\Mime;
use net\razshare\catpaw\tools\Status;
use function Amp\ByteStream\getStdout;

return fn() => new class() extends MainConfiguration{
    public function __construct() {
        $this->webroot = __DIR__.'/public';
		$this->showException = true;
		$this->showStackTrace = false;

		$handler = new StreamHandler(getStdout());
		$handler->setFormatter(new ConsoleFormatter());
		$logger = new Logger('app');
		$logger->pushHandler($handler);

		$this->logger = $logger;
		Factory::setObject(Logger::class,$logger);

		$this->interfaces = [
			"127.0.0.1:80",
		];

        $this->init('app');
    }

    private function init(string $namespace = ""):void{
        Factory::setObject(MainConfiguration::class,$this);

        (new AttributeLoader())
            ->setLocation(__DIR__)
            ->loadModulesFromNamespace($namespace)
            ->loadClassesFromNamespace($namespace);

        chdir('./src');

        Route::notFound(function(
            #[ResponseHeaders] array &$headers,
			Status $status,
            Request $request
        ) {
            $uri 	= $this->webroot.$request->getUri()->getPath();
            if(is_dir($uri)){
                if(str_ends_with($uri,'/'))
                    $uri .= 'index.html';
                else
                    $uri .= '/index.html';
            }

            if(is_file($uri) && !strpos($uri,'../')){
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