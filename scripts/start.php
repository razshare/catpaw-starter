#!/usr/bin/php
<?php
chdir(dirname(__FILE__).'/..');
error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();
ini_set('memory_limit','-1');
require 'vendor/autoload.php';

use com\github\tncrazvan\catpaw\CatPaw;
use com\github\tncrazvan\catpaw\tools\Dir;
use com\github\tncrazvan\catpaw\tools\helpers\Route;
use com\github\tncrazvan\catpaw\tools\helpers\WebsocketRoute;

$_files_last_changed = [];
$count = isset($argv[3])?\intval($argv[3]):0;

function check_file_change(&$_files_last_changed,bool $exit_immediately = true){
    $files = [];
    Dir::findFilesRecursive(dirname(__FILE__)."/../src",$files);

    foreach($files as &$file){
        $name = $file['name'];
        if(isset($_files_last_changed[$name])){
            if($_files_last_changed[$name] < $file['lastChange']){
                echo "Restarting server...\n";
                $_files_last_changed[$name] = $file['lastChange'];
                exit; //stop the server
            }
        }
        $_files_last_changed[$name] = $file['lastChange'];
    }
}

// set_error_handler(
//     function ($severity, $message, $file, $line) {
//         throw new ErrorException($message, $severity, $severity, $file, $line);
//     }
// );

try{
    chdir(dirname(__FILE__).'/..');
    $config = require('catpaw.config.php');

    if(isset($argv[1]) && $argv[1] === 'dev'){
        $delay = isset($argv[2])?\intval($argv[2]):100;
        $listen = function() use (&$_files_last_changed,&$delay){
            check_file_change($_files_last_changed,false);
            return $delay; //wait for $delay ms
        };
    }else 
        $listen = null;

    $server = new CatPaw($config,$listen);

    
}catch(\Throwable $e){
    echo $e->getMessage()."\n";
    echo $e->getTraceAsString()."\n";
    if(isset($argv[1]) && $argv[1] === 'dev') 
        while(true){
            check_file_change($_files_last_changed);
            usleep(10000);
        }
    else 
        exit("Killing server...\n");
}