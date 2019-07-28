<?php

function preload($c){
    if(!opcache_compile_file("/mnt/c/Users/Razvan/Documents/PhpProjects/catpawskeleton/tests/preloading/classes/$c.php")){
        trigger_error("Preloading failed",E_USER_ERROR);
    }
}

preload("A");