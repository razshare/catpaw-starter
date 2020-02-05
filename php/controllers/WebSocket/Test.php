<?php
namespace app\websocket;

use com\github\tncrazvan\catpaw\websocket\WebSocketEvent;
use com\github\tncrazvan\catpaw\websocket\WebSocketController;

class Test extends WebSocketController{
    
    public function onClose(WebSocketEvent &$e, array &$args): void {
        echo "\nWebSocket closed.";
    }

    public function onMessage(WebSocketEvent &$e, string &$data, array &$args): void {
        echo "\nMessage received: $data";
    }

    public function onOpen(WebSocketEvent &$e, array &$args): void {
        echo "\nWebSocket opened.\n";
    }

}
