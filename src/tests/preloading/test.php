<?php
spl_autoload_register('__load');

function __load($c){
    echo "Autoloader called for $c\n";
    require("/mnt/c/Users/Razvan/Documents/PhpProjects/catpawskeleton/tests/preloading/classes/$c.php");
}

new A();