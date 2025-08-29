<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the height of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.5` represents 50% of the original height).
 * You can also supply arithmetic expressions (e.g., `ih_mul_0.5`).
 */
final class Height implements ConverterSource
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
