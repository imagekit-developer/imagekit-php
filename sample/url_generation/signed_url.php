<?php

echo "\033[01;33m\n\n------------------------ Signed URL -----------------------------\033[0m";

// Signed URL
// https://docs.imagekit.io/features/security/signed-urls

$imageURL = $imageKit->url([
    "path" => "/default-image.jpg",
    "queryParameters" => 
    [
        "v" => "123"
    ],
    "transformation" => [
        [
            "height" => "300",
            "width" => "400"
        ]
    ],
    "signed" => true,
    "expireSeconds" => 300, // 300 seconds
]);

echo "\n\n";
echo "Singed Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";
