<?php
use function CatPaw\Core\env;

function main():void {
    $name = env("name");
    echo "Hello $name.\n";
}