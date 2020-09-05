<?php

use app\events\http\homepage\HelloPage;
use com\github\tncrazvan\catpaw\Event;
use com\github\tncrazvan\catpaw\http\HttpConsumer;
use com\github\tncrazvan\catpaw\http\HttpEvent;
use com\github\tncrazvan\catpaw\tools\ServerFile;
use events\websocket\websockettest\WebSocketTest;
use com\github\tncrazvan\catpaw\http\HttpEventOnClose;
use com\github\tncrazvan\catpaw\http\HttpSession;
use com\github\tncrazvan\catpaw\websocket\WebSocketEvent;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnClose;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnMessage;
use com\github\tncrazvan\catpaw\websocket\WebSocketEventOnOpen;

Event::http('/home',function(array &$session){
    $session['time'] = time();
    return "you have a session now!";
});

Event::http('@forward',[
    '/upload/{filename}' => '/asd/{filename}',
    '/upload-old/{filename}' => '/asd-old/{filename}',
]);

Event::http('/asd-old/{filename}',[
    'POST' => function(string $filename, string &$body){
        if(!\file_exists("./uploads/default")){
            mkdir("./uploads/default",0777,true);
        }
        $file = \fopen("./uploads/default/$filename",'a');
        \fwrite($file,$body);
        \fclose($file);

        return "done";
    }
]);

Event::http('/asd/{filename}',[
    'POST' => function(string $filename, string &$body, HttpConsumer $consumer){
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
]);

Event::http('/hello/{test}',
    fn(string $test,HttpEvent $e,HttpEventOnClose &$onClose) 
        => new HelloPage($test,$e,$onClose));

Event::http('/templating/{username}',function(string $username){
    return ServerFile::include('../public/index.php',$username);
});

Event::websocket('/test',
    fn(WebSocketEvent &$e,WebSocketEventOnOpen &$onOpen,WebSocketEventOnMessage &$onMessage,WebSocketEventOnClose &$onClose) 
        => new WebSocketTest($e,$onOpen,$onMessage,$onClose));