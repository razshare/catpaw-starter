<?php
namespace app\http\session;
use com\github\tncrazvan\catpaw\http\HttpResponse;
use com\github\tncrazvan\catpaw\http\HttpController;
class Manager extends HttpController{
  public function main(){
      return new HttpResponse([],"this is Manager");
  }
}