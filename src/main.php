<?php

use function Amp\delay;

function main() {
    echo "hello";
    delay(1);
    echo " world\n";
}