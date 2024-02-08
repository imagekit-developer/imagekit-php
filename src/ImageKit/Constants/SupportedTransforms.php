<?php

namespace ImageKit\Constants;

/**
 *
 */
class SupportedTransforms
{
    private static $transforms = [
        'height' => 'h',
        'width' => 'w',
        'aspectRatio' => 'ar',
        'quality' => 'q',
        'crop' => 'c',
        'cropMode' => 'cm',
        'x' => 'x',
        'y' => 'y',
        'focus' => 'fo',
        'format' => 'f',
        'radius' => 'r',
        'background' => 'bg',
        'border' => 'b',
        'rotation' => 'rt',
        'blur' => 'bl',
        'named' => 'n',
        'progressive' => 'pr',
        'lossless' => 'lo',
        'trim' => 't',
        'metadata' => 'md',
        'colorProfile' => 'cp',
        'defaultImage' => 'di',
        'dpr' => 'dpr',
        'effectSharpen' => 'e-sharpen',
        'effectUSM' => 'e-usm',
        'effectContrast' => 'e-contrast',
        'effectGray' => 'e-grayscale',
        'effectShadow' => 'e-shadow',
        'effectGradient' => 'e-gradient',
        'original' => 'orig',
        'rotate' => 'rt',
    ];

    /**
     * @return array<string, string>
     */
    public static function get()
    {
        return self::$transforms;
    }
}
