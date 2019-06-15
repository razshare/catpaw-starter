<?php
/*
    NOTE: You need to have OpenSSL installed on your system.
    This has only been tested on Linux Ubuntu 18.04 LTS.
*/
require_once __DIR__.'/vendor/autoload.php';
use com\github\tncrazvan\CatPaw\Tools\OpenSSL;

if(!isset($argv[1])) $argv[1] = 365;
if(!isset($argv[2])) $argv[2] = "";

$filename = __DIR__."/certificate.pem";

OpenSSL::mkcert([
    "countryName" => "US",
    "stateOrProvinceName" => "Texas",
    "localityName" => "Houston",
    "organizationName" => "DevDungeon.com",
    "organizationalUnitName" => "Development",
    "commonName" => "DevDungeon",
    "emailAddress" => "nanodano@devdungeon.com"
],$filename,intval($argv[1]),$argv[2]);
echo "\n$filename created.\n"; 
