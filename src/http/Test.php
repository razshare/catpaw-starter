<?php
namespace app\http;

use com\github\tncrazvan\catpaw\http\HttpResponse;
use com\github\tncrazvan\catpaw\http\HttpController;

class Test extends HttpController{
    public function hello(){
        return new HttpResponse([],"this is a test");
    }
}
