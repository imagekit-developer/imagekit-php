<?php

declare(strict_types=1);

namespace Imagekit\TextOverlayTransformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the rotation angle of the text overlay.
 * Accepts a numeric value for clockwise rotation or a string prefixed with "N" for counter-clockwise rotation.
 *
 * @phpstan-type RotationVariants = float|string
 * @phpstan-type RotationShape = RotationVariants
 */
final class Rotation implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['float', 'string'];
    }
}
