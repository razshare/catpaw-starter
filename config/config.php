<?php

use app\http\Home;

return [
    "port" => 80,
    "webRoot" => "../www/public",
    "bindAddress" => "0.0.0.0",
    "namespace" => "app",
    "scripts" => [
        "editor" => "code @filename"
    ],
    "controllers" => [
        "http"=>[
            "/home" => Home::class
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
