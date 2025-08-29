<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the aspect ratio for the output, e.g., "ar-4-3". Typically used with either width or height (but not both).
 * For example: aspectRatio = `4:3`, `4_3`, or an expression like `iar_div_2`.
 */
final class AspectRatio implements ConverterSource
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
