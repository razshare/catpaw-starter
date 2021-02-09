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

set_error_handler(
    function ($severity, $message, $file, $line) {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
);

try{
    chdir(dirname(__FILE__).'/..');
    $config = require('catpaw.config.php');
    if(!is_array($config))
        $config = [];

    if(!isset($config["port"]))
        $config["port"] = 80;

    if(!isset($config["webRoot"]))
        $config["webRoot"] = "public";

    if(!isset($config["sessionName"]))
        $config["sessionName"] = "_SESSION";

    if(!isset($config["asciiTable"]))
        $config["asciiTable"] = false;

    if(!isset($config["httpMtu"]))
        $config["httpMtu"] = 1024 * 1024;

    if(!isset($config["httpMaxBodyLength"]))
        $config["httpMaxBodyLength"] = 1024 * 1024 * 1024 * 20;

    if(!isset($config["events"]))
        $config["events"] = [
            "http" => [],
            "websocket" => []
        ];

    if(!isset($config["events"]["http"]))
        $config["events"]["http"] = array();
    
    if(!isset($config["events"]["websocket"]))
        $config["events"]["websocket"] = array();
    

    $extraRouteConfig = Route::getHttpEvents();
    $extraWebsocketRouteConfig = WebsocketRoute::getWebsocketEvents();

    foreach($extraRouteConfig as $path => &$block){
        if(!isset($config["events"]["http"][$path]))
            $config["events"]["http"][$path] = array();

        foreach($block as $method => &$callback){
            $config["events"]["http"][$path][$method] = $callback;
        }
    }

    foreach($extraWebsocketRouteConfig as $path => &$callback){
        $config["events"]["websocket"][$path] = $callback;
    }

    $server = new CatPaw($config,$count);

    if(isset($argv[1]) && $argv[1] === 'dev'){
        $delay = isset($argv[2])?\intval($argv[2]):100;
        $server->listen(function() use (&$_files_last_changed,&$delay){
            check_file_change($_files_last_changed,false);
            return $delay; //wait for $delay ms
        });
    }else{
        $server->listen();
    }
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