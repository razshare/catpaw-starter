<?php

require_once __DIR__.'/../../../vendor/autoload.php';

use com\github\tncrazvan\asciitable\AsciiCel;
use com\github\tncrazvan\asciitable\AsciiRow;
use com\github\tncrazvan\asciitable\AsciiTable;


$table = new AsciiTable(["width"=>150]);
$table->add("Name", "Value");
$table->add(
    "hello world",
    "this is a table inside a table inside another table"
);

$table2 = new AsciiTable(["width"=>100]);
$table2->add("Name","Value");
$table2->add("AAAAAAAAA",$table->toString(true));

$table3 = new AsciiTable(["width"=>100]);
$table3->add("Name","Value");
$table3->add("BBBBBBBBB", $table2->toString(false));

echo $table3->toString(false)."\n";
