<?php

declare(strict_types=1);

namespace ImageKit\SolidColorOverlayTransformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the corner radius of the solid color overlay. Set to `max` for circular or oval shape.
 * See [radius](https://imagekit.io/docs/effects-and-enhancements#radius---r).
 */
final class Radius implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return ['float', 'string'];
    }
}
