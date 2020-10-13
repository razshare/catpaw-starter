<?php
namespace api\http;

use com\github\tncrazvan\catpaw\http\HttpConsumer;

return function(string $filename, string &$body, HttpConsumer $consumer){
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
};