<?php
namespace scripts\ccli;

use com\github\tncrazvan\catpaw\attributes\ApplicationScoped;
use com\github\tncrazvan\catpaw\attributes\Entry;
use com\github\tncrazvan\catpaw\attributes\Inject;

#[ApplicationScoped]
class CCli{

    public function __construct(
        private array $args
    ){}

    #[Entry]
    public function main(
        #[Inject] CCliEventDispatcher $dispatcher,
    ):void{
        $dispatcher->dispatch(...$this->args);
    }
}