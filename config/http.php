<?php
return [
    "port" => 80,
    "editor" => "code @filename",
    "webRoot" => "../www",
    "bindAddress" => "0.0.0.0",
    "controllers" => [
        "http" => "app\\http",
        "ws" => "app\\websocket",
        "editorScript" => "code @filename"
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
