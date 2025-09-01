<?php

declare(strict_types=1);

namespace ImageKit\OverlayPosition;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the y-coordinate of the top-left corner of the base asset where the overlay's top-left corner will be positioned.
 * It also accepts arithmetic expressions such as `bh_mul_0.4` or `bh_sub_ch`.
 * Maps to `ly` in the URL.
 * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
 */
final class Y implements ConverterSource
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
