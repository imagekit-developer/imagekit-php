<?php

declare(strict_types=1);

namespace ImageKit\TextOverlayTransformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Core\Conversion\EnumOf;

/**
 * Specifies the corner radius of the text overlay.
 * Set to `max` to achieve a circular or oval shape.
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
        return ['float', new EnumOf(['max'])];
    }
}
