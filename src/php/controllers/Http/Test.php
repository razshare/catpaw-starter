<?php
namespace App\Http;

use com\github\tncrazvan\CatPaw\Tools\G;
use com\github\tncrazvan\CatPaw\Http\HttpEvent;
use com\github\tncrazvan\CatPaw\Http\HttpResponse;
use com\github\tncrazvan\CatPaw\Http\HttpController;

class test extends HttpController{
    public function &main(HttpEvent &$e, array &$path, string &$content){
        return new HttpResponse([],"hello world");
    }

    public function onClose(){}
}