<?php

namespace App\Http;

use com\github\tncrazvan\CatPaw\Http\HttpEvent;
use com\github\tncrazvan\CatPaw\Http\HttpController;

class Hello extends HttpController{
    public function &main(HttpEvent &$e, array &$path, string &$content){
        $e->send("hello");
    }
    public function onClose():void{}
}