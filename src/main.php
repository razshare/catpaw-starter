<?php

function main():void {
    $info = ($_ENV["info"] ?? false)?'yes':'no';

    echo "info:$info\n";
}