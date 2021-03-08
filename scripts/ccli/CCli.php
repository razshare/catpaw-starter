<?php
namespace scripts\ccli;

use net\razshare\catpaw\attributes\ApplicationScoped;
use net\razshare\catpaw\attributes\Entry;
use net\razshare\catpaw\attributes\Inject;

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