<?php
use app\http\Hello;

return [
    "port" => 80,
    "webRoot" => "../www",
    "bindAddress" => "0.0.0.0",
    "controllers" => [
        "http"=>[
            "/hello" => Hello::class
        ],
        "websocket"=>[]
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
