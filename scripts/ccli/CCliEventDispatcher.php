<?php
namespace scripts\ccli;
use com\github\tncrazvan\catpaw\attributes\Singleton;

#[Singleton]
class CCliEventDispatcher{
    const MAKE_CONTROLLER = '/^make\s+controller(\s+[A-z]+)?(\s+[A-z]+)?(\s+[A-z]+)?$/';

    const DIALOG_OK=0;
    const DIALOG_CANCEL=1;
    const DIALOG_HELP=2;
    const DIALOG_EXTRA=3;
    const DIALOG_ITEM_HELP=4;
    const DIALOG_ESC=255;

    public function dispatch(
        string ...$args,
    ):CCliEventDispatcher{
        if(\preg_match(static::MAKE_CONTROLLER,implode(' ',$args),$groups))
            return $this->_make_controller();
        
        return $this;
    }

    private function _make_controller():CCliEventDispatcher{
        $filename = dirname(__FILE__).'/templates/controller.txt';
        $template = file_get_contents($filename);

        $http_method = Shell::script(
            'dialog',
            '--clear',
            '--title "Http method"',
            '--menu "Please select and http method for your endpint." 0 0 0',
                '"COPY" "COPY"',
                '"DELETE" "DELETE"',
                '"GET" "GET"',
                '"HEAD" "HEAD"',
                '"LINK" "LINK"',
                '"LOCK" "LOCK"',
                '"OPTIONS" "OPTIONS"',
                '"PATCH" "PATCH"',
                '"POST" "POST"',
                '"PROPFIND" "PROPFIND"',
                '"PURGE" "PURGE"',
                '"PUT" "PUT"',
                '"UNKNOWN" "UNKNOWN"',
                '"UNLOCK" "UNLOCK"',
                '"VIEW" "VIEW"',
            "\nclear"

        )->run();

        if($http_method === '' || $http_method === false)
            die("Invalid http method\n");

        $http_path = Shell::script(
            'dialog',
            '--clear',
            '--title "Http path"',
            '--inputbox "Please specify a path for your endpoint." 0 0',
            "\nclear"

        )->run();

        if($http_path === '' || $http_path === false)
            die("Invalid http path\n");

        $path_pieces = array_map(function($item){
            $pieces = explode('-',$item);
            for($i = 0,$len = count($pieces); $i < $len; $i++){
                if($i > 0){
                    $pieces[$i] = \ucfirst($pieces[$i]);
                }
            }
            return implode('',$pieces);
        },explode('/',$http_path));
        $namespace = preg_replace('/^\\\+/','',implode("\\",array_splice($path_pieces,0,-1)));
        $classname = \ucfirst($path_pieces[0]??$namespace);
        
        

        print_r([
            "namespace" => $namespace,
            "classname" => $classname,
            "http_method" => $http_method,
            "http_path" => $http_path,
        ]);
        
        
        $template = str_replace("%NAMESPACE%",$namespace,$template);
        echo("using namespace: $namespace\n");

        $template = str_replace("%CLASS_NAME%",$classname,$template);
        echo("using classname: $classname\n");

        $template = str_replace("%HTTP_METHOD%",$http_method,$template);
        echo("using http method: $http_method\n");

        $template = str_replace("%HTTP_PATH%",$http_path,$template);
        echo("using path: $http_path\n");

        $filename = dirname(__FILE__)."/../../src/api/$classname.php";
        $dir = dirname($filename);
        if(!is_dir($dir))
            if(!mkdir($dir,0777,true)){
                echo("Could not create directory $dir.\n");
                return $this;
            }
        echo("Writing file $filename\n");
        
        file_put_contents($filename,$template);
        
        echo("Done, remember to execute 'composer dump-autoload -o'.\n");

        return $this;
    }
}