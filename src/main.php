<?php
return [
    "port" => 80,
    "webRoot" => "../public",
    "sessionName" => "../_SESSION",
    "asciiTable" => false,
    "events" => [
        "http"=>[
            "@forward" => [
                '/upload/{filename}' => '/asd/{filename}',
                '/upload-old/{filename}' => '/asd-old/{filename}',
            ],
            "@404"                      => fn()=>"page not found, sorry",
            "/home"                     => [    "GET"   =>      require './api/http/get_home.php'      ],
            "/file-old/{filename}"      => [    "POST"  =>      require './api/http/post_file_old.php' ],
            "/file/{filename}"          => [    "POST"  =>      require './api/http/post_file.php'     ],
            "/hello/{test}"             => [    "GET"   =>      require './api/http/get_hello.php'     ],
            "/templating/{username}"    => [    "GET"   =>      require './api/http/templating.php'    ],
        ],
        "websocket"=>[
            "/test"                     => require './api/websocket/test.php',
        ]
    ]
];