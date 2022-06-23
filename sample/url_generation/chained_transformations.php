<?php

echo "\033[01;33m\n\n---------------- Chained Transformations -----------------------\033[0m";

// https://docs.imagekit.io/features/image-transformations/chained-transformations

// Resize then Rotate

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        
        // It means first resize the image to 400x300 and then rotate 90 degrees
        'transformation' => [
            [
                'width' => '400',
                'height' => '300',
            ],
            [
                'rotation' => '90'
            ]
        ],
    ]
);

echo "\n\n";
echo "1. Resized then rotated Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Rotate then Resize

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        
        // It means first rotate the image to 90 degress and then resize it to 400x300
        'transformation' => [
            [
                'rotation' => '90'
            ],
            [
                'width' => '400',
                'height' => '300',
            ],
        ],
    ]
);

echo "\n\n";
echo "2. Retotated then resized Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

