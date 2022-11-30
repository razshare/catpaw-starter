<?php

use CatPaw\Attributes\Option;

function main(
    #[Option("--test")] string $test,
) {
    echo "$test\n";
}
