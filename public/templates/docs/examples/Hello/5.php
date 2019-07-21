<?php

namespace App\Http;

use com\github\tncrazvan\CatPaw\Tools\Status;
use com\github\tncrazvan\CatPaw\Http\HttpEvent;
use com\github\tncrazvan\CatPaw\Http\HttpResponse;
use com\github\tncrazvan\CatPaw\Http\HttpController;

class Hello extends HttpController{
    public function &main(HttpEvent &$e, array &$path, string &$content){
        return new HttpResponse([
            Status::SUCCESS
        ],"hello");
    }
    public function onClose():void{}
}