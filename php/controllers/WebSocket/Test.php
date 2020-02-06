<?php
namespace app\websocket;

use com\github\tncrazvan\catpaw\websocket\WebSocketEvent;
use com\github\tncrazvan\catpaw\websocket\WebSocketController;

class Test extends WebSocketController{
    
    public function onOpen(){
        echo "WebSocket opened.\n";
    }

    public function onClose(){
        echo "WebSocket closed.\n";
    }

    public function onMessage(string &$data){
        echo "Message received: $data\n";
    }
}
