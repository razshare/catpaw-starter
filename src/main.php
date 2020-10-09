<?php
chdir(dirname(__FILE__));

use com\github\tncrazvan\catpaw\Event;

return [
    "port" => 80,
    "webRoot" => "../public",
    "sessionName" => "../_SESSION",
    "events" => [
        "http"=>[
            "@forward" => [
                '/upload/{filename}' => '/asd/{filename}',
                '/upload-old/{filename}' => '/asd-old/{filename}',
            ],

            "/home" => include './api/http/get_home.php',

            "/asd-old/{filename}" => ["POST" => include './api/http/post_asd_old.php'],

            "/asd/{filename}" => ["POST" => include './api/http/post_asd.php'],
            
            "/hello/{test}" => include './api/http/get_home.php',

            "/templating/{username}" => include './api/http/templating.php'
        ],
        "websocket"=>[
            "/test" => include './api/websocket/test.php'
        ]
    ]
];