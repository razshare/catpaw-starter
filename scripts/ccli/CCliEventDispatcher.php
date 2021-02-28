<?php
namespace scripts\ccli;
use com\github\tncrazvan\catpaw\attributes\Singleton;
use com\github\tncrazvan\catpaw\services\FileReaderService;
use React\EventLoop\LoopInterface;
use React\Stream\WritableResourceStream;

#[Singleton]
class CCliEventDispatcher{
    const MAKE_CONTROLLER = '/^make\s+controller(\s+[A-z]+)(\s+[A-z]+)?(\s+[A-z]+)?$/';

    public function dispatch(
        string ...$args,
    ):CCliEventDispatcher{
        if(\preg_match(static::MAKE_CONTROLLER,implode(' ',$args),$groups))
            return $this->_make_controller(...[...\array_splice($groups,1),'GET','/']);
        return $this;
    }

    private function _make_controller(string ...$groups):CCliEventDispatcher{
        $filename = dirname(__FILE__).'/templates/controller.txt';
        $template = file_get_contents($filename);
        $groups = array_map(fn($item)=>trim($item),$groups);
        [
            $classname,
            $http_method,
            $http_path
        ] = $groups;

        echo("Prepearing to create controller \api\{$classname}...\n");

        if(!str_starts_with($http_path,"/"))
            $http_path = "/$http_path";

        $http_path = \explode('/',$http_path);

        $http_path_count = \count($http_path);

        $http_base_path = implode('/',array_splice($http_path,0,$http_path_count-1));
        if(!str_starts_with($http_base_path,"/"))
            $http_base_path = "/$http_base_path";

        if($http_path_count === 2){
            $http_path = '/';
        }else{
            $http_path = implode('/',array_splice($http_path,$http_path_count-1,1));
            if(!str_starts_with($http_path,"/"))
                $http_path = "/$http_path";
        }
        
        $template = str_replace("%CLASS_NAME%",$classname,$template);
        $template = str_replace("%HTTP_METHOD%",$http_method,$template);
        echo("using http method: $http_method\n");
        $template = str_replace("%HTTP_BASE_PATH%",$http_base_path,$template);
        echo("using base path: $http_base_path\n");
        $template = str_replace("%HTTP_PATH%",$http_path,$template);
        echo("using local path: $http_path\n");

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