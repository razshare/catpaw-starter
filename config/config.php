<?php
return [
    "port" => 80,
    "webRoot" => "../www",
    "bindAddress" => "0.0.0.0",
    "scripts" => [
        "editor" => "code @filename",
        "minify" => "minify --type=@type \"@filename\""
    ],
    "controllers" => [
        "http"=>[],
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
