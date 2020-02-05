<?php
return [
    "minifier"=> [
        "location"=>"minify/linux/minify",
        "sleep"=>1000
    ],
    "port" => 80,
    "webRoot" => "../www",
    "bindAddress" => "0.0.0.0",
    "controllers" => [
        "http" => "app\\http",
        "ws" => "app\\http"
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
