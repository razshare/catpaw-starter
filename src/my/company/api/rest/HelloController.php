<?php
namespace my\company\api\rest;

use com\github\tncrazvan\catpaw\attributes\http\methods\GET;
use com\github\tncrazvan\catpaw\attributes\http\Path;
use com\github\tncrazvan\catpaw\attributes\Produces;
use com\github\tncrazvan\catpaw\attributes\Singleton;

#[Singleton]
#[Path("/hello")]
#[Produces("text/html")]
class HelloController{

    #[GET]
    public function hello():string{
        return "hello from controller!";
    }
}