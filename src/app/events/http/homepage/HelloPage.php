<?php
namespace app\events\http\homepage;

use com\github\tncrazvan\catpaw\http\HttpEvent;
use com\github\tncrazvan\catpaw\http\HttpEventHandler;
use com\github\tncrazvan\catpaw\http\HttpEventOnClose;
use com\github\tncrazvan\catpaw\tools\ServerFile;
use HttpMethodGet;

class HelloPage extends HttpEventHandler implements HttpMethodGet/*,HttpMethodPost,HttpMethodPut,...,HttpMethodUnknown*/{
    private string $test;
    private HttpEvent $e;
    public function __construct(string $test, HttpEvent $e, ?HttpEventOnClose &$onClose = null){
        $this->test = $test;
        $this->e=$e;
        if($onClose !== null)
            $onClose = new Close();
    }
    public function get(){
        return ServerFile::response($this->e,$this->e->listener->so->webRoot,"index.html");
    }
}

class Close extends HttpEventOnClose{
    public function run():void{
        
    }
}