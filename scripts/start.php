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
$_last_error_shown = false;
$_current_error = '';
$_last_error_table = null;
$count = isset($argv[3])?\intval($argv[3]):0;
while(true){
    try{
        chdir(dirname(__FILE__).'/../src');
        $config = require('main.php');
        $server = new CatPaw($config,$count);

        if(isset($argv[1]) && $argv[1] === 'dev'){
            $delay = isset($argv[2])?\intval($argv[2]):100;
            $server->listen(function() use (&$_files_last_changed,&$_last_error_shown,&$_current_error,&$delay){
                $files = [];
                Dir::findFilesRecursive(dirname(__FILE__)."/../src",$files);
        
                foreach($files as &$file){
                    $name = $file['name'];
                    if(isset($_files_last_changed[$name])){
                        if($_files_last_changed[$name] < $file['lastChange']){
                            $_last_error_shown = '';
                            $_current_error = '';
                            echo "Restarting server...\n";
                            $_files_last_changed[$name] = $file['lastChange'];
                            exit; //stop the server
                        }
                    }
                    $_files_last_changed[$name] = $file['lastChange'];
                }
        
                return $delay; //wait for 2000 ms
            });
        }else{
            $server->listen();
        }
    }catch(\Throwable $e){
        $trace = $e->getTraceAsString();
        $code = $e->getCode();
        $message = $e->getMessage();
        $line = $e->getLine();
        $file = $e->getFile();
        $_current_error = "$trace\n$code\n$file\n$file\n$line\n$message";
        if($_last_error_shown === '' || $_last_error_shown !== $_current_error){
            $_last_error_table = new AsciiTable();
            $_last_error_table->style(0,[
                "width"=>50
            ]);
            $_last_error_table->style(1,[
                "width"=>200
            ]);

            echo "$trace\n";
            $_last_error_table->add("Code",$code);
            $_last_error_table->add("File",$file);
            $_last_error_table->add("Line",$line);
            $_last_error_table->add("Message",$message);
            echo $_last_error_table->toString()."\n";
            $_last_error_shown = $_current_error;
        }
    }
}
