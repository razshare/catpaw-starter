<?php

namespace App\Http;

use com\github\tncrazvan\CatPaw\Http\HttpController;
use com\github\tncrazvan\CatPaw\Http\HttpEvent;

class Hello extends HttpController{
    public function &main(HttpEvent &$e, array &$path, string &$content){

    }
    public function onClose():void{}
}