#!/usr/bin/php
<?php
chdir(dirname(__FILE__).'/..');
error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();
ini_set('memory_limit','-1');
require 'vendor/autoload.php';

use com\github\tncrazvan\asciitable\AsciiTable;
use com\github\tncrazvan\catpaw\CatPaw;
use com\github\tncrazvan\catpaw\tools\Dir;

$_files_last_changed = [];
$count = isset($argv[3])?\intval($argv[3]):0;

function manage_throwable(\Throwable $e){
    $trace = $e->getTraceAsString();
    $code = $e->getCode();
    $message = $e->getMessage();
    $line = $e->getLine();
    $file = $e->getFile();

    $table = new AsciiTable();
    $table->style(0,[
        "width"=>50
    ]);
    $table->style(1,[
        "width"=>128
    ]);

    $message_pieces = \preg_split('/\n/',$message);
    $message = '';
    $size = 0;
    foreach($message_pieces as &$piece){
        $l_size = strlen($piece);
        $size += $l_size;
        if($size >= 127){
            $message .="\n";
            $size = $l_size;
        }
        $message .=$piece;
    }

    echo "$trace\n";
    $table->add("Code",$code);
    $table->add("File",$file);
    $table->add("Line",$line);
    $table->add("Message",$message);
    echo $table->toString()."\n";
}

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
    chdir(dirname(__FILE__).'/../src');
    $config = @require('main.php');
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
    manage_throwable($e);
    while(true){
        check_file_change($_files_last_changed);
        usleep(10000);
    }
}