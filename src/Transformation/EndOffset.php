<?php

declare(strict_types=1);

namespace Imagekit\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the end offset (in seconds) for trimming videos, e.g., `5` or `10.5`.
 * Typically used with startOffset to define a time window. Arithmetic expressions are supported.
 * See [Trim videos – End offset](https://imagekit.io/docs/trim-videos#end-offset---eo).
 *
 * @phpstan-type EndOffsetVariants = float|string
 * @phpstan-type EndOffsetShape = EndOffsetVariants
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
