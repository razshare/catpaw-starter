<?php
namespace api\http\handlers;

use com\github\tncrazvan\catpaw\http\HttpEvent;
use com\github\tncrazvan\catpaw\http\HttpEventHandler;
use com\github\tncrazvan\catpaw\tools\ServerFile;

class Hello extends HttpEventHandler{

    public static function map(\stdClass $e):array{
        return [
            static::target("GET", "/{username}", $e->get),
            static::target("POST", "/", $e->post),
        ];
    }


    public function get(string $username){
        return "hello $username!";
    }

    private static int $i = 0;
    public function post(){
        yield;
        self::$i++;
        yield;
        self::$i++;
        yield;
        self::$i++;
        return self::$i++;
    }
}