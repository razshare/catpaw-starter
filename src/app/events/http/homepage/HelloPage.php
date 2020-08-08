<?php
namespace app\events\http\homepage;

use com\github\tncrazvan\catpaw\http\HttpEvent;
use com\github\tncrazvan\catpaw\http\HttpEventHandler;
use com\github\tncrazvan\catpaw\http\HttpEventOnClose;
use com\github\tncrazvan\catpaw\tools\ServerFile;
use HttpMethodGet;

class HelloPage extends HttpEventHandler implements HttpMethodGet{
    private string $test;
    private HttpEvent $e;
    private static int $i = 0;
    public function __construct(string $test, HttpEvent $e, ?HttpEventOnClose &$onClose = null){
        $this->test = $test;
        $this->e=$e;
        if($onClose !== null)
            $onClose = new Close();
    }
    public function get(){
        yield;
        self::$i++;
        yield;
        self::$i++;
        yield;
        self::$i++;
        return self::$i++;
    }
}

class Close extends HttpEventOnClose{
    public function run():void{
        
    }
}