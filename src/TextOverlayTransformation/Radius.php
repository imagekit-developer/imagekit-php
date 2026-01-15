<?php

declare(strict_types=1);

namespace Imagekit\TextOverlayTransformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the corner radius:
 * - Single value (positive integer): Applied to all corners (e.g., `20`).
 * - `max`: Creates a circular or oval shape.
 * - Per-corner array: Provide four underscore-separated values representing top-left, top-right, bottom-right, and bottom-left corners respectively (e.g., `10_20_30_40`).
 * See [Radius](https://imagekit.io/docs/effects-and-enhancements#radius---r).
 *
 * @phpstan-type RadiusVariants = float|string|'max'
 * @phpstan-type RadiusShape = RadiusVariants
 */
final class Radius implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['float', 'string', 'string'];
    }
}
