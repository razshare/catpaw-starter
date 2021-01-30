<?php
namespace my\company\config;

use com\github\tncrazvan\catpaw\attributes\Entry;
use com\github\tncrazvan\catpaw\attributes\Singleton;

#[Singleton]
class ApplicationConfiguration{

    #[Entry]
    public function test(){
        echo "test test\n";
    }
}