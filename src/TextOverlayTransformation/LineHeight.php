<?php

declare(strict_types=1);

namespace ImageKit\TextOverlayTransformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the line height of the text overlay.
 * Accepts integer values representing line height in points. It can also accept [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations) such as `bw_mul_0.2`, or `bh_div_20`.
 */
final class LineHeight implements ConverterSource
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
