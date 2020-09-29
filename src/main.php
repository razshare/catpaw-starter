<?php
chdir(dirname(__FILE__));
use app\events\http\homepage\HelloPage;
use com\github\tncrazvan\catpaw\Event;
use com\github\tncrazvan\catpaw\http\HttpConsumer;
use com\github\tncrazvan\catpaw\http\HttpEvent;
use com\github\tncrazvan\catpaw\tools\ServerFile;
use events\websocket\websockettest\WebSocketTest;
use com\github\tncrazvan\catpaw\http\HttpEventOnClose;
use com\github\tncrazvan\catpaw\websocket\WebSocketEvent;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnClose;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnMessage;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnOpen;

function get_home(array &$session):string{
    $session['time'] = time();
    return "you have a session now!";
}

function post_asd_old(string $filename, string &$body):string{
    if(!\file_exists("./uploads/default")){
        mkdir("./uploads/default",0777,true);
    }
    $file = \fopen("./uploads/default/$filename",'a');
    \fwrite($file,$body);
    \fclose($file);

    return "done";
}

function post_asd(string $filename, string &$body, HttpConsumer $consumer){
    if(!\file_exists("./uploads/consumer")){
        mkdir("./uploads/consumer",0777,true);
    }
    $file = \fopen("./uploads/consumer/$filename",'a');
    for($consumer->rewind();$consumer->valid();$consumer->consume($body)){
        \fwrite($file,$body);
        yield $consumer;
    }
    \fclose($file);

    return "done";
}


return [
    "port" => 80,
    "webRoot" => "../public",
    "events" => [
        "http"=>[
            "@forward" 
            => [
                '/upload/{filename}' => '/asd/{filename}',
                '/upload-old/{filename}' => '/asd-old/{filename}',
            ],

            "/home"
                =>fn(array &$session)
                    =>get_home($session),

            "/asd-old/{filename}"
            => [
                "POST"
                    =>fn(string &$filename,string &$body)
                        =>post_asd_old($filename,$body)
            ],

            "/asd/{filename}"
                =>fn(string &$filename, string &$body, HttpConsumer $consumer)
                    =>post_asd($filename,$body,$consumer),
            
            "/hello/{test}"
                => fn(string $test,HttpEvent $e,HttpEventOnClose &$onClose) 
                    => new HelloPage($test,$e,$onClose),

            "/templating/{username}"
                => fn(string &$username)
                    =>ServerFile::include('../public/index.php',$username),

            "/test"
                =>fn(WebSocketEvent &$e,WebSocketEventOnOpen &$onOpen,WebSocketEventOnMessage &$onMessage,WebSocketEventOnClose &$onClose) 
                    => new WebSocketTest($e,$onOpen,$onMessage,$onClose)
        ],
        "websocket"=>Event::getWebsocketEvents()
    ]
];