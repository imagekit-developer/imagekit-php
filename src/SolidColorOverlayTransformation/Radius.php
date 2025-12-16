<?php

declare(strict_types=1);

namespace Imagekit\SolidColorOverlayTransformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the corner radius of the solid color overlay. Set to `max` for circular or oval shape.
 * See [radius](https://imagekit.io/docs/effects-and-enhancements#radius---r).
 *
 * @phpstan-type RadiusShape = float|'max'
 */
final class Radius implements ConverterSource
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
