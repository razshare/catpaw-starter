<?php
namespace app\http;

use com\github\tncrazvan\catpaw\http\HttpResponse;
use com\github\tncrazvan\catpaw\http\HttpController;

class Hello extends HttpController{
    public function main():void{
        $this->send("hello");
    }
    public function onClose():void{}
}
