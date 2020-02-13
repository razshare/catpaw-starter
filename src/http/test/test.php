<?php
namespace app\http\test;
use com\github\tncrazvan\catpaw\http\HttpResponse;
use com\github\tncrazvan\catpaw\http\HttpController;
class test extends HttpController{
  public function main(){
      return new HttpResponse([],"this is test");
  }
}