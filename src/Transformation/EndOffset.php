<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the end offset (in seconds) for trimming videos, e.g., `5` or `10.5`.
 * Typically used with startOffset to define a time window. Arithmetic expressions are supported.
 * See [Trim videos – End offset](https://imagekit.io/docs/trim-videos#end-offset---eo).
 */
final class EndOffset implements ConverterSource
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
