<?php
use com\github\tncrazvan\catpaw\misc\AttributeLoader;
(new AttributeLoader())->setLocation(__DIR__)->load();
require_once './src/main.php';
return [
    "port" => 8080
];