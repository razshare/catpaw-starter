<?php

use app\http\About;
use app\http\Home;

return [
    "port" => 80,
    "webRoot" => "../www",
    "bindAddress" => "0.0.0.0",
    "namespace" => "app",
    "scripts" => [
        "editor" => "code @filename",
        "minify" => "minify --type=@type \"@filename\""
    ],
    "controllers" => [
        "http"=>[
            "/about" => About::class,
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