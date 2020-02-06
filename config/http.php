<?php
return [
    "port" => 80,
    "webRoot" => "../www",
    "bindAddress" => "0.0.0.0",
    "controllers" => [
        "http" => "app\\http",
        "ws" => "app\\websocket"
    ],
    "sessionName" => "_SESSION",
    "ramSession" => [
        "allow" => false,
        "size" => "1024M"
    ],
    "compress" => ["deflate"],
    "header" => [
        "Cache-Control" => "no-store"
    ]
];
