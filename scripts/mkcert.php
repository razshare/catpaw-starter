<?php
/**
 * Makes a PEM certificate.
 * NOTE: You need to have OpenSSL installed on your system.
 * Tested on Ubuntu 18.04 LTS.
 */
chdir(dirname(__FILE__).'/..');
require_once './vendor/autoload.php';
use com\github\tncrazvan\catpaw\tools\OpenSSL;

$blueprint = [
    "countryName" => "__", //your organization country (2 letters, for example "US")
    "stateOrProvinceName" => "_____", //your organization province or state
    "localityName" => "_____", //your organization city or town
    "organizationName" => "__________", //your organization name
    "organizationalUnitName" => "_____", //name of your organization unit, for example "Web Development"
    "commonName" => "__________.___", //your organization website address
    "emailAddress" => "__________@__________.___" //your organization email address
];

$first=true;
while(true){
    $askField = true;
    $emailRegex = "/(?<=^)[A-z0-9!#$%&'*+-\\/=?^_`{|}~]*\\.?[A-z0-9!#$%&'*+-\\/=?^_`{|}~]*\\@[A-z0-9][A-z0-9]*[A-z0-9](\\.[A-z]+)?(?=$)/";

    if($first){
        while(true){
            $countryName = trim(readline("Country Name (2 letter code): "));
            if(preg_match('/^[A-z]{2}$/',$countryName)) break;
            echo "[Country Name] must be a 2 letters country code. Try again.\n";
        }
        while(true){
            $stateOrProvinceName = trim(readline("State or Province name: "));
            if($stateOrProvinceName !== "") break;
            echo "[State or Province name] must not be empty. Try again.\n";
        }
        
        while(true){
            $localityName = trim(readline("Locality Name: "));
            if($localityName !== "") break;
            echo "[Locality Name] must not be empty. Try again.\n";
        }

        while(true){
            $organizationName = trim(readline("Organization Name: "));
            if($organizationName !== "") break;
            echo "[Organization Name] must not be empty. Try again.\n";
        }

        $organizationalUnitName = trim(readline("Organizational Unit Name: "));

        while(true){
            $commonName = trim(readline("Common Name: "));
            if($commonName !== "") break;
            echo "[Common Name] must not be empty. Try again.\n";
        }

        while(true){
            $emailAddress = trim(readline("Email Address: "));
            if($emailAddress === "") break;
            if(preg_match($emailRegex,$emailAddress)) break;
            echo "Invalid email format.\n";
        }
    }else{
        while(true){
            $countryName = trim(readline("Country Name (2 letter code - {$blueprint['countryName']}): "));
            if($countryName === "") $countryName = $blueprint["countryName"];
            if(preg_match('/^[A-z]{2}$/',$countryName))
                break;
            echo "[Country Name] must be a 2 letters country code. Try again.\n";
        }

        $stateOrProvinceName = trim(readline("State or Province name ({$blueprint['stateOrProvinceName']}): "));
        if($stateOrProvinceName === "") $stateOrProvinceName = $blueprint["stateOrProvinceName"];

        $localityName = trim(readline("Locality Name ({$blueprint['localityName']}): "));
        if($localityName === "") $localityName = $blueprint["localityName"];


        $organizationName = trim(readline("Organization Name ({$blueprint['organizationName']}): "));
        if($organizationName === "") $organizationName = $blueprint["organizationName"];

        $organizationalUnitName = trim(readline("Organizational Unit Name ({$blueprint['organizationalUnitName']}): "));
        if($organizationalUnitName === "") $organizationalUnitName = $blueprint["organizationalUnitName"];

        $commonName = trim(readline("Common Name ({$blueprint['commonName']}): "));
        if($commonName === "") $commonName = $blueprint["commonName"];

        while(true){
            $emailAddress = trim(readline("Email Address ({$blueprint['emailAddress']}): "));
            if($emailAddress === "") $emailAddress = $blueprint["emailAddress"];
            if($emailAddress === "") break;
            if(preg_match($emailRegex,$emailAddress))
                break;
            else
                echo "Invalid email format.\n";
        }
    }
    $blueprint["countryName"] = $countryName;
    $blueprint["stateOrProvinceName"] = $stateOrProvinceName;
    $blueprint["localityName"] = $localityName;
    $blueprint["organizationName"] = $organizationName;
    $blueprint["organizationalUnitName"] = $organizationalUnitName;
    $blueprint["commonName"] = $commonName;
    $blueprint["emailAddress"] = $emailAddress;

    echo "\n";
    echo print_r($blueprint,true);
    echo "\n";
    $confirmation = trim(strtolower(readline("Is this information correct? (Y/n) ")));
    if($confirmation === "y" || $confirmation == "")
        break;
    $first = false;
}
while(true){
    $validity = trim(readline("Validity (days - optional - 365): "));
    if($validity === "") $validity = 365;
    if(preg_match('/^[0-9]*$/',$validity)) break;
    echo "[Validity] must be a numeric value or empty string, in which case the value will be set to 365 days by default. Try again.\n";
}
$passphrase = OpenSSL::readLineSilent("Passphrase (optional): ");
echo "Your certificate will be valid for $validity days.\n";
$filename = "./certificate.pem";
if(OpenSSL::mkcert($blueprint,$filename,$passphrase,intval($validity))){
    echo "\n$filename created.\n";
}
