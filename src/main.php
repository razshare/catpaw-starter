<?php
namespace app;
use app\homepage\HomePage;
use app\websockettest\WebSocketTest;
use com\github\tncrazvan\catpaw\http\HttpEvent;
use com\github\tncrazvan\catpaw\http\HttpEventOnClose;
use com\github\tncrazvan\catpaw\http\HttpResponse;
use com\github\tncrazvan\catpaw\tools\Http;
use com\github\tncrazvan\catpaw\tools\ServerFile;
use com\github\tncrazvan\catpaw\tools\Status;
use com\github\tncrazvan\catpaw\websocket\WebSocketEvent;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnClose;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnMessage;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnOpen;

$webRoot = "../public/www/";

return [
    "port" => 80,
    "webRoot" => &$webRoot,
    "bindAddress" => "127.0.0.1",
    "events" => [
        "http"=>[
            "@forward" => [
                "/asd" => "/track.mp3"
            ],
            "@404" 
                => function(HttpEvent $e){
                    $filename = [$e->listener->so->webRoot,$e->listener->path];
                    if(!ServerFile::exists(...$filename)){
                        $filename = [ServerFile::dirname(...$filename),"index.html"];
                        if(!ServerFile::exists(...$filename)){
                            return new HttpResponse([
                                "Status" => Status::NOT_FOUND
                            ]);
                        }
                    }else if(ServerFile::isDir(...$filename)){
                        $filename[] = "index.html";
                        if(!ServerFile::exists(...$filename)){
                            return new HttpResponse([
                                "Status" => Status::NOT_FOUND
                            ]);
                        }
                    }

                    return ServerFile::response($e,...$filename);
                },
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