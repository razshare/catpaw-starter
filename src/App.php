<?php
use com\github\tncrazvan\catpaw\attributes\Entry;
use com\github\tncrazvan\catpaw\tools\helpers\Factory;
use com\github\tncrazvan\catpaw\tools\helpers\Route;
Factory::make(App::class);

class App{
    #[Entry]
    public static function main(string ...$args){
        Route::get("/",function(){
            return "hello world";
        });
    }
}
