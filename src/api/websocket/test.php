<?php

use api\websocket\handlers\Test;
use com\github\tncrazvan\catpaw\websocket\WebSocketEvent;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnClose;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnMessage;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnOpen;

return fn(
    WebSocketEvent &$e,
    WebSocketEventOnOpen &$onOpen,
    WebSocketEventOnMessage &$onMessage,
    WebSocketEventOnClose &$onClose) 
    => new Test($e,$onOpen,$onMessage,$onClose);