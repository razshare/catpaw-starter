<?php

use com\github\tncrazvan\catpaw\attributes\http\methods\GET;
use com\github\tncrazvan\catpaw\attributes\http\Path;
use com\github\tncrazvan\catpaw\attributes\Produces;

#[Path("/")]
#[Produces("text/html")]
class SampleResource{

    #[GET]
    public function index():string{
        return "this is index";
    }
}