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
            "/home"                     => [    "GET"   =>      require './api/http/get_home.php'      ],
            "/asd-old/{filename}"       => [    "POST"  =>      require './api/http/post_asd_old.php'  ],
            "/asd/{filename}"           => [    "POST"  =>      require './api/http/post_asd.php'      ],
            "/hello/{test}"             => [    "GET"   =>      require './api/http/get_hello.php'     ],
            "/templating/{username}"    => [    "GET"   =>      require './api/http/templating.php'    ],
        ],
        "websocket"=>[
            "/test"                     => [    "GET"   =>      require './api/websocket/test.php'     ],
        ]
    ]
];