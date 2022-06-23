<?php
echo "\033[01;33m\n\n-------- Resize, crop and other common transformations ---------\033[0m";

// URL for Image with relative path

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg', 
    ]
);

echo "\n\n";
echo "1. URL for Image with relative path: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// URL for Image with relative path and custom URL Endpoint

$imageURL = $imageKit->url(
    [
        'urlEndpoint' => $url_end_point . '/sample-folder',
        'path' => '/default-image.jpg', 
    ]
);


echo "\n\n";
echo "2. URL for Image with relative path and Custom URL Endpoint: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

//  URL for Image with absolute url

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/test/default-image.jpg'
    ]
);

echo "\n\n";
echo "3. URL for Image with Absolute URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Resizing Images

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'width' => '400',
            ],
        ],
    ]
);

echo "\n\n";
echo "4. Resized Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Pad resize crop strategy (cm-pad_resize)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#pad-resize-crop-strategy-cm-pad_resize

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'width' => '400',
                'cropMode' => 'pad_resize',
                'background' => 'F3F3F3'
            ],
        ],
    ]
);

echo "\n\n";
echo "5. Pad Resize Crop Strategy Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Pad resize crop strategy with Focus (fo)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#pad-resize-crop-strategy-cm-pad_resize
// More on 'fo' - https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#focus-fo

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'width' => '400',
                'cropMode' => 'pad_resize',
                'background' => 'D3D3D3',
                'focus' => 'left',
            ],
        ],
    ]
);

echo "\n\n";
echo "6. Pad Resize Crop Strategy with Focus-Left Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Forced crop strategy (c-force)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#forced-crop-strategy-c-force

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'width' => '400',
                'crop' => 'force',
                'background' => 'F3F3F3',
            ],
        ],
    ]
);

echo "\n\n";
echo "7. Forced Crop Strategy Strategy Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Max-size cropping strategy (c-at_max)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#max-size-cropping-strategy-c-at_max

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'width' => '400',
                'crop' => 'at_max',
            ],
        ],
    ]
);

echo "\n\n";
echo "8. Max-size cropping strategy Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Min-size cropping strategy (c-at_least)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#min-size-cropping-strategy-c-at_least

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'width' => '400',
                'crop' => 'at_least',
            ],
        ],
    ]
);

echo "\n\n";
echo "9. Min-size cropping strategy Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Maintain ratio crop strategy c-maintain_ratio (center-top)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#maintain-ratio-crop-strategy-c-maintain_ratio

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'height' => '300',
                'width' => '400',
                'crop' => 'maintain_ratio',
            ],
        ],
    ]
);

echo "\n\n";
echo "10. Maintain ratio cropping strategy (center-top) Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Maintain ratio crop strategy with fo-custom
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#maintain-ratio-crop-strategy-c-maintain_ratio

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/img/bike-image.jpeg',
        'transformation' => [
            [
                'height' => '300',
                'width' => '400',
                'focus' => 'custom',
            ],
        ],
    ]
);

echo "\n\n";
echo "11. Maintain ratio cropping strategy with fo-custom Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Extract crop strategy cm-extract (default center extract)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#extract-crop-strategy-cm-extract

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'width' => '200',
                'height' => '200',
                'cropMode' => 'extract',
            ],
        ],
    ]
);

echo "\n\n";
echo "12. Extract crop strategy (default center extract) Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Extract crop strategy cm-extract (relative focus)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#extract-crop-strategy-cm-extract

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'width' => '200',
                'height' => '200',
                'cropMode' => 'extract',
                'focus' => 'bottom_right',
            ],
        ],
    ]
);

echo "\n\n";
echo "13. Extract crop strategy (relative focus) Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Extract crop strategy cm-extract (focus with x,y coordinates)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#examples-focus-using-cropped-image-coordinates

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'width' => '200',
                'height' => '200',
                'cropMode' => 'extract',
                'x' => '100',
                'y' => '300',
            ],
        ],
    ]
);

echo "\n\n";
echo "14. Extract crop strategy (Focus with X,Y Coordinates) Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Extract crop strategy cm-extract (focus using xc,yc center coordinates)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#examples-focus-using-cropped-image-coordinates

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'width' => '200',
                'height' => '200',
                'cropMode' => 'extract',
                'xc' => '100',
                'yc' => '300',
            ],
        ],
    ]
);

echo "\n\n";
echo "15. Extract crop strategy (Focus using center Coordinates XC, YC) Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Extract crop strategy cm-extract (focus with custom coordinates)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#example-focus-using-custom-coordinates

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/img/bike-image.jpeg',
        'transformation' => [
            [
                'width' => '200',
                'height' => '200',
                'cropMode' => 'extract',
                'focus' => 'custom'
            ],
        ],
    ]
);

echo "\n\n";
echo "16. Extract crop strategy (Focus using custom coordinates) Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Pad extract crop strategy (cm-pad_extract)
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#pad-extract-crop-strategy-cm-pad_extract

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'width' => '200',
                'height' => '200',
                'cropMode' => 'pad_extract',
                'background' => 'F3F3F3',
            ],
        ],
    ]
);

echo "\n\n";
echo "17. Pad extract crop strategy Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Quality manipulation

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'quality' => '40',
            ],
        ],
    ]
);

echo "\n\n";
echo "18. Quality Manipulated Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Blur Image

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'blur' => '40',   // 1-100
            ],
        ],
    ]
);

echo "\n\n";
echo "19. Blur Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Grayscale Image (e-grayscale)

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'effectGray' => '',
            ],
        ],
    ]
);

echo "\n\n";
echo "20. Grayscale Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Trim edges 

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/img/trim_example_BkgQVu7oX.png',
        'transformation' => [
            [
                'trim' => 'true',    // true|Number
            ],
        ],
    ]
);

echo "\n\n";
echo "21. Trim edges Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";


// Bordered Image 
// https://docs.imagekit.io/features/image-transformations/resize-crop-and-other-transformations#border-b

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'border' => '10_FF0000',    // width_hexcolor
            ],
        ],
    ]
);

echo "\n\n";
echo "22. Bordered Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Rotate Image 

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'rotate' => '180',    // degrees
            ],
        ],
    ]
);

echo "\n\n";
echo "23. Rotated Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Radius 

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                // 'radius' => '100', 
                'radius' => 'max',    
            ],
        ],
    ]
);

echo "\n\n";
echo "24. Radius Applied Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Background color 

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'width' => '1200',
                'height' => '1200',
                'cropMode' => 'pad_extract',
                'background' => '272B38',    
            ],
        ],
    ]
);

echo "\n\n";
echo "25. Background color Applied Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Download Image 

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'width' => '1200',
                'height' => '1200',
                'cropMode' => 'pad_extract',
                'background' => '272B38',    
            ],
        ],
        'queryParameters' => [
            'ik-attachment' => 'true'
        ]
    ]
);

echo "\n\n";
echo "26. Download Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";
