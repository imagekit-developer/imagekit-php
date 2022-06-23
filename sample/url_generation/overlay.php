<?php

echo "\033[01;33m\n\n------------------------ Overlay --------------------------------\033[0m";
// https://docs.imagekit.io/features/image-transformations/overlay

// Adding overlays to images

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/medium_cafe_B1iTdD0C.jpg',
        'transformation' => [
            [
                'overlayImage' => 'logo-white_SJwqB4Nfe.png',
            ]
        ],
    ]
);

echo "\n\n";
echo "1. Basic Overlay Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay X position - (ox)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-x-position-ox

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/medium_cafe_B1iTdD0C.jpg',
        'transformation' => [
            [
                'overlayImage' => 'logo-white_SJwqB4Nfe.png',
                'overlayX' => '35',
            ]
        ],
    ]
);

echo "\n\n";
echo "2. Overlay X position Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay X position - ox (Negative Value)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-x-position-ox

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/medium_cafe_B1iTdD0C.jpg',
        'transformation' => [
            [
                'overlayImage' => 'logo-white_SJwqB4Nfe.png',
                'overlayX' => 'N35',
            ]
        ],
    ]
);

echo "\n\n";
echo "3. Overlay X position (Negative Value) Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay Y position - (oy)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-y-position-oy

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/medium_cafe_B1iTdD0C.jpg',
        'transformation' => [
            [
                'overlayImage' => 'logo-white_SJwqB4Nfe.png',
                'overlayY' => '35',
            ]
        ],
    ]
);

echo "\n\n";
echo "4. Overlay Y position Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay Y position - oy (Negative Value)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-y-position-oy

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/medium_cafe_B1iTdD0C.jpg',
        'transformation' => [
            [
                'overlayImage' => 'logo-white_SJwqB4Nfe.png',
                'overlayY' => 'N35',
            ]
        ],
    ]
);

echo "\n\n";
echo "5. Overlay Y position (Negative Value) Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay height - (oh)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-height-oh

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/medium_cafe_B1iTdD0C.jpg',
        'transformation' => [
            [
                'overlayImage' => 'logo-white_SJwqB4Nfe.png',
                'overlayHeight' => '20',
            ]
        ],
    ]
);

echo "\n\n";
echo "6. Overlay height Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay width - (ow)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-width-ow

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/medium_cafe_B1iTdD0C.jpg',
        'transformation' => [
            [
                'overlayImage' => 'logo-white_SJwqB4Nfe.png',
                'overlayWidth' => '50',
            ]
        ],
    ]
);

echo "\n\n";
echo "7. Overlay width Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay focus - (ofo)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-focus-ofo

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/medium_cafe_B1iTdD0C.jpg',
        'transformation' => [
            [
                'overlayImage' => 'logo-white_SJwqB4Nfe.png',
                'overlayFocus' => 'bottom_left',
            ]
        ],
    ]
);

echo "\n\n";
echo "8. Overlay Focus Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay Background - (obg)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-background-obg

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/medium_cafe_B1iTdD0C.jpg',
        'transformation' => [
            [
                'overlayBackground' => 'FF0000',
                'overlayWidth' => '250',
                'overlayHeight' => '20',
                'overlayFocus' => 'bottom',
            ]
        ],
    ]
);

echo "\n\n";
echo "9. Overlay Background Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay Image Without Trimming
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-image-oi

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/demo/medium_cafe_B1iTdD0C.jpg',
        'transformation' => [
            [     
                'overlayImage' => 'logo_white_black_bg.png',
                'overlayImageTrim' => 'false',
            ]
        ],
    ]
);

echo "\n\n";
echo "10. Overlay Image Without Trimming Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay image aspect ratio (oiar)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-image-aspect-ratio-oiar

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/ikmedia/white-canvas.png',
        'transformation' => [
            [
                'width' => '700',
                'height' => '450',
            ],
            [     
                'overlayImage' => 'default-image.jpg',
                'overlayX' => '0',
                'overlayY' => '0',
                'overlayWidth' => '600', 
                'overlayImageAspectRatio' => '4-3', 
            ],
            [
                'overlayImage' => 'default-image.jpg',
                'overlayX' => '500',
                'overlayY' => '100',
                'overlayWidth' => '200', 
                'overlayImageAspectRatio' => '3-4', 
            ]
        ],
    ]
);

echo "\n\n";
echo "11. Overlay image aspect ratio Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay image background (oibg)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-image-background-oibg

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/ikmedia/white-canvas.png',
        'transformation' => [
            [
                'width' => '1000',
                'height' => '1000',
            ],
            [     
                'overlayImage' => 'default-image.jpg',
                'overlayX' => '0',
                'overlayY' => '0',
                'overlayWidth' => '1000',
                'overlayHeight' => '500', 
                'overlayImageCroppingMode' => 'pad_resize', 
                'overlayImageFocus' => 'left', 
                'overlayImageBackground' => '00FFFF', 
            ],
            [
                'overlayImage' => 'default-image.jpg',
                'overlayX' => '0',
                'overlayY' => '500',
                'overlayWidth' => '1000',
                'overlayHeight' => '500', 
                'overlayImageCroppingMode' => 'pad_resize', 
                'overlayImageFocus' => 'right', 
                'overlayImageBackground' => 'FF0000', 
            ]
            
        ]
    ]
);

echo "\n\n";
echo "12. Overlay image background Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay image border (oib)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-image-border-oib

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/ikmedia/white-canvas.png',
        'transformation' => [
            [
                'width' => '1040',
                'height' => '520',
            ],
            [     
                'overlayImage' => 'default-image.jpg',
                'overlayX' => '0',
                'overlayY' => '10',
                'overlayWidth' => '500',
                'overlayHeight' => '500',
                'overlayImageBorder' => '10_FF0000' 
            ],
            [
                'overlayImage' => 'default-image.jpg',
                'overlayX' => '520',
                'overlayY' => '10',
                'overlayWidth' => '500',
                'overlayHeight' => '500', 
                'overlayImageBorder' => '10_00FFFF'
            ]
            
        ]
    ]
);

echo "\n\n";
echo "13. Overlay image border Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay image quality (oiq)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-image-quality-oiq

$imageURL = $imageKit->url(
    [
        'src' => 'https://ik.imagekit.io/ikmedia/white-canvas.png',
        'transformation' => [
            [
                'width' => '1000',
                'height' => '1000',
            ],
            [
                'width' => '700',
                'height' => '450',
            ],
            [     
                'overlayImage' => 'default-image.jpg',
                'overlayX' => '0',
                'overlayY' => '0',
                'overlayWidth' => '600', 
                'overlayImageAspectRatio' => '4-3', 
                'overlayImageQuality' => '10'
            ],
            [
                'overlayImage' => 'default-image.jpg',
                'overlayX' => '500',
                'overlayY' => '100',
                'overlayWidth' => '200', 
                'overlayImageAspectRatio' => '3-4', 
                'overlayImageQuality' => '100'
            ]
        ]
    ]
);

echo "\n\n";
echo "14. Overlay image quality Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Check for other overlay image cropping

// Overlay text (ot)
// https://docs.imagekit.io/features/image-transformations/overlay#text-overlay

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayText' => 'Overlay Made Easy',
            ],
        ]
    ]
);

echo "\n\n";
echo "15. Overlay text Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay text font size (ots)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-text-size-ots

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayText' => 'Overlay Made Easy',
                'overlayTextFontSize' => '45',
            ],
        ]
    ]
);

echo "\n\n";
echo "16. Overlay text font size Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay text encoded (ote)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-text-encoded-ote

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayTextEncoded' => urlencode(base64_encode('Overlay Made Easy & Quick')),
                'overlayTextFontSize' => '45',
            ],
        ]
    ]
);

echo "\n\n";
echo "17. Overlay text encoded Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay text width (otw)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-text-width-otw

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayText' => 'Overlay Made Easy',
                'overlayTextFontSize' => '45',
                'overlayTextWidth' => '200',
            ],
        ]
    ]
);

echo "\n\n";
echo "18. Overlay text width Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay text background (otbq)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-text-background-otbg

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayTextEncoded' => urlencode(base64_encode('Overlay Made Easy')),
                'overlayTextFontSize' => '45',
                'overlayTextWidth' => '200',
                'overlayTextBackground' => 'FFFFFF',
            ],
        ]
    ]
);

echo "\n\n";
echo "19. Overlay text background Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay text padding (otp)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-text-padding-otp

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayTextEncoded' => urlencode(base64_encode('Overlay Made Easy')),
                'overlayTextFontSize' => '45',
                'overlayTextBackground' => 'FFFFFF',
                // 'overlayTextPadding' => '40',   // all
                // 'overlayTextPadding' => '25_50_75_100',   // top_right_bottom_left
                // 'overlayTextPadding' => '25_75_60',   // top_rightleft_bottom
                'overlayTextPadding' => '25_75',   // topbottom_rightleft
            ],
        ]
    ]
);

echo "\n\n";
echo "20. Overlay text padding Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay text inner alignment (otia)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-text-inner-alignment-otia

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayTextEncoded' => urlencode(base64_encode('Overlay Made Easy')),
                'overlayTextFontSize' => '30',
                'overlayTextBackground' => 'FFFFFF',
                'overlayTextPadding' => '20',
                'overlayTextWidth' => '400',
                'overlayTextInnerAlignment' => 'left',
            ],
        ]
    ]
);

echo "\n\n";
echo "21. Overlay text inner alignment Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay text color (otc)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-text-color-otc

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayTextEncoded' => urlencode(base64_encode('Overlay Made Easy')),
                'overlayTextFontSize' => '30',
                'overlayTextPadding' => '20',
                'overlayTextWidth' => '400',
                'overlayTextColor' => '00FFFF', // for opacity 55% <hex><opacity> e.g. 00FFFF55
            ],
        ]
    ]
);

echo "\n\n";
echo "21. Overlay text color Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay text font (otf)
// For fonts list and custom font refer to this: 
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-text-font-otf

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayTextEncoded' => urlencode(base64_encode('Overlay Made Easy')),
                'overlayTextFontSize' => '30',
                'overlayTextBackground' => 'FFFFFF',
                'overlayTextFontFamily' => 'Open Sans'
            ],
        ]
    ]
);

echo "\n\n";
echo "22. Overlay text font Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay text typography (ott)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-text-typography-ott

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayTextEncoded' => urlencode(base64_encode('Overlay Made Easy')),
                'overlayTextFontSize' => '30',
                'overlayTextBackground' => 'FFFFFF',
                'overlayTextTypography' => 'i', // b-bold, i -italic
            ],
        ]
    ]
);

echo "\n\n";
echo "23. Overlay text typography 'bold' Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay radius (or)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-radius-or

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayTextEncoded' => urlencode(base64_encode('Overlay Made Easy')),
                'overlayTextFontSize' => '30',
                'overlayTextBackground' => 'FFFFFF',
                'overlayTextPadding' => '30',
                'overlayRadius' => '30'
            ],
        ]
    ]
);

echo "\n\n";
echo "24. Overlay text radius Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

// Overlay transparency (oa)
// https://docs.imagekit.io/features/image-transformations/overlay#overlay-transparency-oa

$imageURL = $imageKit->url(
    [
        'path' => '/default-image.jpg',
        'transformation' => [
            [
                'overlayTextEncoded' => urlencode(base64_encode('Overlay Made Easy')),
                'overlayTextFontSize' => '30',
                'overlayTextBackground' => 'FFFFFF',
                'overlayTextPadding' => '30',
                'overlayRadius' => '30',
                'overlayTextTransparency' => '5',
            ],
        ]
    ]
);

echo "\n\n";
echo "25. Overlay text transparency Image URL: \n";
echo "\033[01;32m$imageURL\033[0m";
echo "\n";

