<?php

echo "\n\n------------------------------------------------------------";
echo "\n\n------------------------ Metadata --------------------------";
echo "\n\n------------------------------------------------------------";
echo "\n";

// Create Fields

$body = [
    "name" => "net_price",              // required
    "label" => "Net Price",        // required
    "schema" => [                   // required
        "type" => 'Number',         // required
        "minValue" => 1000,
        "maxValue" => 5000,
    ],
];

$createCustomMetadataField = $imageKit->createCustomMetadataField($body);

echo "\n\n";
echo "1. Create Fields: \n";
echo "\033[01;32m".print_r($createCustomMetadataField,true)."\033[0m";
echo "\n";

// Get Fields

$includeDeleted = false;
$getCustomMetadataFields = $imageKit->getCustomMetadataFields($includeDeleted);
$customMetadataFieldId = $getCustomMetadataFields->result[0]->id;

echo "\n\n";
echo "2. Get Fields: \n";
echo "\033[01;32m".print_r($getCustomMetadataFields,true)."\033[0m";
echo "\n";

// Update Field

$body = [
    "label" => "Net Price2",
    "schema" => [
        "type"=>'Number'
    ],
];

$updateCustomMetadataField = $imageKit->updateCustomMetadataField($customMetadataFieldId, $body);

echo "\n\n";
echo "3. Update Field: \n";
echo "\033[01;32m".print_r($updateCustomMetadataField,true)."\033[0m";
echo "\n";

// Delete Field

$deleteCustomMetadataField = $imageKit->deleteCustomMetadataField($customMetadataFieldId);

echo "\n\n";
echo "4. Delete Field: \n";
echo "\033[01;32m".print_r($deleteCustomMetadataField,true)."\033[0m";
echo "\n";

