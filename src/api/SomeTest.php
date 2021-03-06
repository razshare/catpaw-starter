<?php
namespace api;

use com\github\tncrazvan\catpaw\attributes\http\methods\GET;
use com\github\tncrazvan\catpaw\attributes\http\Path;
use com\github\tncrazvan\catpaw\attributes\Produces;
use com\github\tncrazvan\catpaw\attributes\Singleton;

#[Singleton]
#[Path("/api/some-test")]
class SomeTest{

    #[GET]
    #[Produces("text/plain,text/html")]
    public function todo():string{
        return "todo";
    }
}


