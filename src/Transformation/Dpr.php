<?php

declare(strict_types=1);

namespace Imagekit\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Accepts values between 0.1 and 5, or `auto` for automatic device pixel ratio (DPR) calculation. Also accepts arithmetic expressions.
 * - Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
 * - See [DPR](https://imagekit.io/docs/image-resize-and-crop#dpr---dpr).
 *
 * @phpstan-type DprVariants = float|string
 * @phpstan-type DprShape = DprVariants
 */
final class Dpr implements ConverterSource
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
