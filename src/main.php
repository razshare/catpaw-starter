<?php
use function CatPaw\Core\env;

function main():void {
    echo 'Hello '.env("name").PHP_EOL;
}