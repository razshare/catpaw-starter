<?php
namespace api\http;

return function(string $filename, string &$body):string{
    if(!\file_exists("./uploads/default")){
        mkdir("./uploads/default",0777,true);
    }
    $file = \fopen("./uploads/default/$filename",'a');
    \fwrite($file,$body);
    \fclose($file);

    return "done";
};