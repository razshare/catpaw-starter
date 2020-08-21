<?php

use app\events\http\homepage\HelloPage;
use com\github\tncrazvan\catpaw\http\HttpConsumer;
use com\github\tncrazvan\catpaw\http\HttpEvent;
use com\github\tncrazvan\catpaw\tools\ServerFile;
use events\websocket\websockettest\WebSocketTest;
use com\github\tncrazvan\catpaw\http\HttpEventOnClose;
use com\github\tncrazvan\catpaw\tools\HttpLiveBodyInjection;
use com\github\tncrazvan\catpaw\websocket\WebSocketEvent;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnClose;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnMessage;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnOpen;

return [
    "port" => 80,
    "webRoot" => "../public",
    "bindAddress" => "127.0.0.1",
    "httpMtu" => 1024*1024*5, //5 MB
    "events" => [
        "http"=>[
            "@forward" => [ //forward requests to routes (order matters)
                "/upload/{filename}" => "/asd/{filename}",
                "/upload-old/{filename}" => "/asd-old/{filename}",
            ],
            "/asd-old/{filename}" => function(string $filename, string &$body){
                if(!\file_exists("uploads/default"))
                    mkdir("uploads/default",0777,true);
                $file = \fopen("./uploads/default/$filename",'a');
                \fwrite($file,$body);
                \fclose($file);

                return "done";
            },
            "/asd/{filename}" => function(string $filename, string &$body, HttpConsumer $consumer){
                if(!\file_exists("uploads/consumer"))
                    mkdir("uploads/consumer",0777,true);
                $file = \fopen("./uploads/consumer/$filename",'a');
                for($consumer->rewind();$consumer->valid();$consumer->consume($body)){
                    \fwrite($file,$body);
                    yield $consumer;
                }
                \fclose($file);

                return "done";
            },
            "/hello/{test}"  => fn(string $test,HttpEvent $e,HttpEventOnClose &$onCLose) => new HelloPage($test,$e,$onCLose),
            "/templating/{username}" => function(string $username){
                return ServerFile::include('../public/index.php',$username);
            }  
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