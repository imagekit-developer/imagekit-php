<?php

echo "\033[01;33m\n\n------------- Image Enhancement & Color Manipulation ------------\033[0m";

// https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation

// Contrast stretch (e-contrast)
// https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation#contrast-stretch-e-contrast

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/sample_image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'effectContrast' => '',
            ]
        ],
    ]
);

echo "\n\n";
echo "1. Contrast stretch Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Sharpen (e-sharpen)
// https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation#sharpen-e-sharpen

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/sample_image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'effectSharpen' => '10',
            ]
        ],
    ]
);

echo "\n\n";
echo "2. Sharpen Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Unsharp mask (e-usm)
// https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation#unsharp-mask-e-usm

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/sample_image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'effectUSM' => '2-2-0.8-0.024', // radius=2, sigma=2, amount=0.8, threshold=0.024
            ]
        ],
    ]
);

echo "\n\n";
echo "3. Unsharp mask Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Shadow (e-shadow)
// https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation#shadow-e-shadow

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/sample_image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'effectShadow' => 'bl-15_st-40_x-10_y-N5'
            ]
        ],
    ]
);

echo "\n\n";
echo "4. Shadow image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Gradient (e-gradient)
// https://docs.imagekit.io/features/image-transformations/image-enhancement-and-color-manipulation#gradient-e-gradient

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/sample_image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'effectGradient' => 'from-red_to-white',
            ]
        ],
    ]
);

echo "\n\n";
echo "5. Gradient image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";