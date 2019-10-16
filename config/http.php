<?php
return [
    "minifier"=> [
        "location"=>"minify/linux/minify",
        "sleep"=>10
    ],
    "port" => 80,
    "webRoot" => "../www",
    "bindAddress" => "0.0.0.0",
    "controllers" => [
        "http" => "App\\Http",
        "ws" => "App\\Http"
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