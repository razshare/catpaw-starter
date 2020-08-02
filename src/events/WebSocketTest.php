<?php
namespace app\websockettest;
use com\github\tncrazvan\catpaw\websocket\WebSocketClassEvent;
use com\github\tncrazvan\catpaw\websocket\WebSocketEvent;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnClose;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnOpen;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnMessage;

class WebSocketTest extends WebSocketClassEvent{
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
    public function run(string &$data):void{
        echo "Received:$data\n";
        $this->e->commit("back at you: $data");
    }
}

class Close extends WebSocketEventOnClose{
    public function run():void{
        echo "bye!\n";
    }
}