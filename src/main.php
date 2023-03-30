<?php

use function CatPaw\readline;

function main() {
    $username = yield readline("What is your username? ");
    echo "username: $username";

    $password = yield readline("What is your password? ");
    echo "password: $password";
}
