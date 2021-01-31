<?php
use com\github\tncrazvan\catpaw\attributes\Entry;
use com\github\tncrazvan\catpaw\attributes\Singleton;

#[Singleton]
class App{

    #[Entry]
    public function test(){
        echo "hello world\n";
    }
}