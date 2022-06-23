<?php

echo "\n\n------------------------------------------------------------";
echo "\n\n------------ SERVER SIDE FILE UPLOAD SAMPLES ---------------";
echo "\n\n------------------------------------------------------------";
echo "\n";

// Upload Image - Base64

$img = file_get_contents(__DIR__ . '/sample_image.jpeg');

// Encode the image string data into base64
$encodedImageData = base64_encode($img);
$options = [
    'folder' => 'sample-folder',
    'tags' => implode(['abd', 'def']),
    'useUniqueFileName' => false,
    'customCoordinates' => implode(',', ['10', '10', '100', '100'])
];

$uploadFile = $imageKit->upload([
    'file' => $encodedImageData,
    'fileName' => 'sample-base64-upload',
    'options' => $options
]);

echo "\n\n";
echo "1. Upload Image (Base64) - Response: \n";
echo "\033[01;32m".print_r($uploadFile, true)."\033[0m";
echo "\n";

// Upload Image - Binary

$options = [
    'folder' => 'sample-folder',
    'tags' => implode(['abd', 'def']),
    'useUniqueFileName' => true,
    'customCoordinates' => implode(',', ['10', '10', '100', '100'])
];

$uploadFile = $imageKit->upload([
    'file' => fopen(__DIR__ . '/sample_image.jpeg', 'r'),
    'fileName' => 'sample-binary-upload',
    'options' => $options
]);

echo "\n\n";
echo "2. Upload Image (Binary) - Response: \n";
echo "\033[01;32m".print_r($uploadFile, true)."\033[0m";
echo "\n";


// Upload Image - URL

$options = [
    'folder' => 'sample-folder',
    'tags' => implode(['abd', 'def']),
    'useUniqueFileName' => true,
    'customCoordinates' => implode(',', ['10', '10', '100', '100'])
];

$uploadFile = $imageKit->upload([
    'file' => $sample_file_url,
    'fileName' => 'sample-url-upload',
    'options' => $options
]);

echo "\n\n";
echo "3. Upload Image (URL) - Response: \n";
echo "\033[01;32m".print_r($uploadFile, true)."\033[0m";
echo "\n";
