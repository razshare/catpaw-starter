<?php
namespace App\WebSocket;

use com\github\tncrazvan\CatPaw\WebSocket\WebSocketEvent;
use com\github\tncrazvan\CatPaw\WebSocket\WebSocketController;

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