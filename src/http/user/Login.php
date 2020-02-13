<?php
namespace app\http\user;
use com\github\tncrazvan\catpaw\http\HttpResponse;
use com\github\tncrazvan\catpaw\http\HttpController;
class Login extends HttpController{
  public function main(){
      return new HttpResponse([],"this is Login");
  }
}