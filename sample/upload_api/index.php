<?php

echo "\n\n------------------------------------------------------------";
echo "\n\n------------ SERVER SIDE FILE UPLOAD SAMPLES ---------------";
echo "\n\n------------------------------------------------------------";
echo "\n";

// Upload Image - Base64

$img = file_get_contents(__DIR__ . '/sample_image.jpeg');

// Encode the image string data into base64
$encodedImageData = base64_encode($img);

$uploadFile = $imageKit->uploadFile([
    'file' => $encodedImageData,
    'fileName' => 'sample-base64-upload',
    'folder' => 'sample-folder',
    'tags' => implode(['abd', 'def']),
    'useUniqueFileName' => false,
    'customCoordinates' => implode(',', ['10', '10', '100', '100']),
    'transformation' => [ 
        'pre' => 'l-text,i-Imagekit,fs-50,l-end', 
        'post' => [
            [ 
                'type' => 'transformation', 
                'value' => 'h-100' 
            ]
        ]
    ],
]);

echo "\n\n";
echo "1. Upload Image (Base64) - Response: \n";
echo "\033[01;32m".print_r($uploadFile, true)."\033[0m";
echo "\n";

// Upload Image - Binary

$uploadFile = $imageKit->uploadFile([
    'file' => fopen(__DIR__ . '/sample_image.jpeg', 'r'),
    'fileName' => 'sample-binary-upload',
    'folder' => 'sample-folder',
    'tags' => implode(['abd', 'def']),
    'useUniqueFileName' => true,
    'customCoordinates' => implode(',', ['10', '10', '100', '100']),
    'transformation' => [ 
        'pre' => 'l-text,i-Imagekit,fs-50,l-end', 
        'post' => [
            [ 
                'type' => 'transformation', 
                'value' => 'h-100' 
            ]
        ]
    ],
]);

echo "\n\n";
echo "2. Upload Image (Binary) - Response: \n";
echo "\033[01;32m".print_r($uploadFile, true)."\033[0m";
echo "\n";


// Upload Image - URL

$uploadFile = $imageKit->uploadFile([
    'file' => $sample_file_url,
    'fileName' => 'sample-url-upload',
    'folder' => 'sample-folder',
    'tags' => implode(['abd', 'def']),
    'useUniqueFileName' => true,
    'customCoordinates' => implode(',', ['10', '10', '100', '100']),
    'transformation' => [ 
        'pre' => 'l-text,i-Imagekit,fs-50,l-end', 
        'post' => [
            [ 
                'type' => 'transformation', 
                'value' => 'h-100' 
            ]
        ]
    ],
]);

echo "\n\n";
echo "3. Upload Image (URL) - Response: \n";
echo "\033[01;32m".print_r($uploadFile, true)."\033[0m";
echo "\n";
