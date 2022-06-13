<?php

echo "\n\n------------------------------------------------------------";
echo "\n\n------------------- Utility Functions ----------------------";
echo "\n\n------------------------------------------------------------";
echo "\n";

// // Authentication parameter generation

$authenticationParameters = $imageKit->getAuthenticationParameters($token = "", $expire = 0);  

echo "\n\n";
echo "1. Authentication parameter generation: \n";
echo "\033[01;32m".print_r($authenticationParameters,true)."\033[0m";
echo "\n";

// Distance calculation between two pHash values
$firstHash='f06830ca9f1e3e90';
$secondHash='f06830ca9f1e3e90';
$pHashDistance = $imageKit->pHashDistance($firstHash ,$secondHash);  

echo "\n\n";
echo "2. Distance calculation between two pHash values: \n";
echo "\033[01;32m".print_r($pHashDistance,true)."\033[0m";
echo "\n";

