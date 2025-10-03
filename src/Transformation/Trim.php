<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Useful for images with a solid or nearly solid background and a central object. This parameter trims the background,
 * leaving only the central object in the output image.
 * See [Trim edges](https://imagekit.io/docs/effects-and-enhancements#trim-edges---t).
 */
final class Trim implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return ['bool', 'float'];
    }
}
