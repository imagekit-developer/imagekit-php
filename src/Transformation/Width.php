<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the width of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.4` represents 40% of the original width).
 * You can also supply arithmetic expressions (e.g., `iw_div_2`).
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
