<?php

declare(strict_types=1);

namespace Imagekit\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the duration (in seconds) for trimming videos, e.g., `5` or `10.5`.
 * Typically used with startOffset to indicate the length from the start offset. Arithmetic expressions are supported.
 * See [Trim videos – Duration](https://imagekit.io/docs/trim-videos#duration---du).
 *
 * @phpstan-type DurationShape = float|string
 */
final class Duration implements ConverterSource
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
