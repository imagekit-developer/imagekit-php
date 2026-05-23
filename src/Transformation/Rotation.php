<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the rotation angle in degrees. Positive values rotate the image clockwise; you can also use, for example, `N40` for counterclockwise rotation
 * or `auto` to use the orientation specified in the image's EXIF data.
 * For videos, only the following values are supported: 0, 90, 180, 270, or 360.
 * See [Rotate](https://imagekit.io/docs/effects-and-enhancements#rotate---rt).
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
