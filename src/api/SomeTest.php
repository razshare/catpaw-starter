<?php
namespace api;

use com\github\tncrazvan\catpaw\attributes\http\methods\DELETE;
use com\github\tncrazvan\catpaw\attributes\http\Path;
use com\github\tncrazvan\catpaw\attributes\Produces;
use com\github\tncrazvan\catpaw\attributes\Singleton;

#[Path("/api/some-test")]
#[Singleton]
class SomeTest{

    #[DELETE]
    #[Produces("text/plain,text/html")]
    public function todo():string{
        return "todo";
    }
}