<?php

namespace app\http;

use com\github\tncrazvan\catpaw\tools\Status;
use com\github\tncrazvan\catpaw\http\HttpResponse;
use com\github\tncrazvan\catpaw\http\HttpController;

class Hello extends HttpController{
    public function main():HttpResponse{
        return new HttpResponse([
            "Status" => Status::SUCCESS
        ],"hello");
    }
    public function onClose():void{}
}
