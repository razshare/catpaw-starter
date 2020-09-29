<?php
error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();
ini_set('memory_limit','-1');
require('vendor/autoload.php');
use com\github\tncrazvan\catpaw\CatPaw;
$server = new CatPaw(require('./src/main.php'));
$server->listen();
