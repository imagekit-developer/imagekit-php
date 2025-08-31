<?php

declare(strict_types=1);

namespace ImageKit\SolidColorOverlayTransformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Controls the width of the solid color overlay. Accepts a numeric value or an arithmetic expression (e.g., `bw_mul_0.2` or `bh_div_2`).
 * Learn about [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
 */
final class Width implements ConverterSource
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
