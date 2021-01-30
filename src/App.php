<?php
use com\github\tncrazvan\catpaw\attributes\Entry;
use com\github\tncrazvan\catpaw\attributes\Inject;
use com\github\tncrazvan\catpaw\attributes\Singleton;
use com\github\tncrazvan\catpaw\misc\AttributeLoader;
use com\github\tncrazvan\catpaw\tools\helpers\Factory;
use com\github\tncrazvan\catpaw\tools\helpers\SimpleQueryBuilder;

Factory::make(App::class);

#[Singleton]
class App{
    #[Inject]
    private AttributeLoader $loader;

    #[Entry]
    public function main(string ...$args):void{
        $this->loader
        ->setLocation(__DIR__.'/../')
        ->load("my\\company");

        echo "hello world!\n";
    }
}
