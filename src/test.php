<?php
function test() {
    $i = 0;
    yield;
    $i++;
    yield;
    $i++;
    yield;
    $i++;
    yield;
    $i++;
    yield;
    $i++;
    return $i;
}


$generator = test();
while($generator->valid()){
    echo $generator->current()."\n";
    $generator->next();
}
$result = $generator->getReturn();
print_r($result);