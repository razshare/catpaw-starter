<?php
use com\github\tncrazvan\catpaw\attributes\http\Headers;
use com\github\tncrazvan\catpaw\misc\AttributeLoader;
use com\github\tncrazvan\catpaw\tools\helpers\Route;
use com\github\tncrazvan\catpaw\tools\Status;
(new AttributeLoader())->setLocation(__DIR__)->load();

Route::notFound(function(
    #[Status] Status $status,
    #[Headers] array &$headers
){
    $status->setCode(Status::NOT_FOUND);
    $headers["Content-Type"] = "text/html";
    return '';
});

require_once './src/main.php';
return [
    "port" => 8080
];