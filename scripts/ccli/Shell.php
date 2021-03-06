<?php
namespace scripts\ccli;

class Shell{
    protected string $args = "";
    public static function script(string|int|float|bool ...$args):static{
        $instance = new static();
        foreach($args as $arg)
            $instance->add($arg);
        return $instance;
    }

    public function run():string|false{
        $pipes = array (NULL, NULL, NULL);
        // Allow user to interact with dialog
        $in = fopen ('php://stdin', 'r');
        $out = fopen ('php://stdout', 'w');
        // But tell PHP to redirect stderr so we can read it
        $p = proc_open ($this->args, array (
            0 => $in,
            1 => $out,
            2 => array ('pipe', 'w')
        ), $pipes);
        // Wait for and read result
        $result = stream_get_contents ($pipes[2]);
        // Close all handles
        fclose ($pipes[2]);
        fclose ($out);
        fclose ($in);
        proc_close ($p);
        // Return result
        return $result;
    }

    public function reset():static{
        $this->args = "";
        return $this;
    }
    public function add(string|int|float|bool $value):static{
        $this->args .= ' '.$value;
        return $this;
    }
}