<?php

declare(strict_types=1);

namespace Imagekit\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the start offset (in seconds) for trimming videos, e.g., `5` or `10.5`.
 * Arithmetic expressions are also supported.
 * See [Trim videos – Start offset](https://imagekit.io/docs/trim-videos#start-offset---so).
 *
 * @phpstan-type StartOffsetShape = float|string
 */
final class StartOffset implements ConverterSource
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
