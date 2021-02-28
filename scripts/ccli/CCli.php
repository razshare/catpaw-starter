<?php
namespace scripts\ccli;

use com\github\tncrazvan\catpaw\attributes\Entry;
use com\github\tncrazvan\catpaw\attributes\Inject;
use com\github\tncrazvan\catpaw\attributes\Singleton;
use com\github\tncrazvan\catpaw\services\FileReaderService;
use React\EventLoop\LoopInterface;
use React\Stream\WritableResourceStream;

#[Singleton]
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