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
        'overlayImage' => 'oi',
        'overlayX' => 'ox',
        'overlayY' => 'oy',
        'overlayFocus' => 'ofo',
        'overlayHeight' => 'oh',
        'overlayWidth' => 'ow',
        'overlayText' => 'ot',
        'overlayTextFontSize' => 'ots',
        'overlayTextFontFamily' => 'otf',
        'overlayTextColor' => 'otc',
        'overlayAlpha' => 'oa',
        'overlayTextTypography' => 'ott',
        'overlayBackground' => 'obg',
        'overlayImageTrim' => 'oit',
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
        'original' => 'orig',
        'rotate' => 'rt',
        'overlayImageAspectRatio' => 'oiar',
        'overlayImageBackground' => 'oibg',
        'overlayImageBorder' => 'oib',
        'overlayImageDPR' => 'oidpr',
        'overlayImageQuality' => 'oiq',
        'overlayImageCropping' => 'oic',
        'overlayTextTransparency' => 'oa',
        'overlayTextEncoded' => 'ote',
        'overlayTextWidth' => 'otw',
        'overlayTextBackground' => 'otbg',
        'overlayTextPadding' => 'otp',
        'overlayTextInnerAlignment' => 'otia',
        'overlayRadius' => 'or',
        'overlayImageFocus' => 'oifo'
    ];

    /**
     * @return array<string, string>
     */
    public static function get()
    {
        return self::$transforms;
    }
}
