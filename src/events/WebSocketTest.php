<?php
namespace app\websockettest;

use com\github\tncrazvan\catpaw\tools\LinkedList;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventInterface;
use com\github\tncrazvan\catpaw\websocket\WebSocketEvent;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnClose;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnOpen;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnMessage;

class WebSocketTest implements WebSocketEventInterface{
    public function __construct(WebSocketEvent $event,?WebSocketEventOnOpen &$onOpen = null,?WebSocketEventOnMessage &$onMessage = null, ?WebSocketEventOnClose &$onClose = null){
        $onOpen = new Open();
        $onMessage = new Message($event);
        $onClose = new Close();
    }
}

class Open extends WebSocketEventOnOpen{
    public function run():void{
        echo "hello world!\n";
    }
}

class Message extends WebSocketEventOnMessage{
    private WebSocketEvent $e;
    public function __construct(WebSocketEvent $e){
        $this->e = $e;
    }
    public function run(LinkedList &$fragments):void{
        $size = 0;
        $fragments->iterate(
            LinkedList::IT_MODE_FIFO,function(LinkedList $payload) use(&$size){
                $payload->iterate(LinkedList::IT_MODE_FIFO,function() use(&$size){
                    $size++;
                }); 
            }
        );
        echo "size: $size\n";
    }
}

class Close extends WebSocketEventOnClose{
    public function run():void{
        echo "bye!\n";
    }
}