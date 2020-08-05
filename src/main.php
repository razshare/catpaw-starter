<?php
namespace app;
use app\homepage\HomePage;
use app\websockettest\WebSocketTest;
use com\github\tncrazvan\catpaw\http\HttpEvent;
use com\github\tncrazvan\catpaw\http\HttpEventOnClose;
use com\github\tncrazvan\catpaw\tools\Http;
use com\github\tncrazvan\catpaw\websocket\WebSocketEvent;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnClose;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnMessage;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnOpen;

return [
    "port" => 80,
    "webRoot" => "../public/www/",
    "bindAddress" => "127.0.0.1",
    "namespace" => "my\\app",
    "events" => [
        "http"=>[
            "@404" 
                => fn(HttpEvent $e) 
                    => Http::getFile($e,$e->listener->so->webRoot,implode('/',$e->listener->location)),
            "/home/{test}" 
                => fn(string $test,HttpEvent $e,HttpEventOnClose &$onCLose) 
                    => new HomePage($test,$e,$onCLose)
        ],
        "websocket"=>[
            "/test"
                => fn(WebSocketEvent &$e,WebSocketEventOnOpen &$onOpen,WebSocketEventOnMessage &$onMessage,WebSocketEventOnClose &$onClose) 
                    => new WebSocketTest($e,$onOpen,$onMessage,$onClose)
        ]
    ],
    "sessionName" => "_SESSION",
    "ramSession" => [
        "allow" => false,
        "size" => "1024M"
    ],
    "compress" => ["deflate"],
    "headers" => [
        "Cache-Control" => "no-store"
    ]
];