<?php

require_once __DIR__.'/../../../vendor/autoload.php';

use com\github\tncrazvan\AsciiTable\AsciiCel;
use com\github\tncrazvan\AsciiTable\AsciiRow;
use com\github\tncrazvan\AsciiTable\AsciiTable;


$table = new AsciiTable();

$table->add("Name", "Value");
$table->add("hello world","testqwrqwrqr");
$table2 = new AsciiTable();

$table2->add("Name","Value");
$table2->add("AAAAAAAAA",$table->toString(true));

echo $table2->toString(true)."\n";