<?php

declare(strict_types=1);

namespace Imagekit\OverlayPosition;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the x-coordinate of the top-left corner of the base asset where the overlay's top-left corner will be positioned.
 * It also accepts arithmetic expressions such as `bw_mul_0.4` or `bw_sub_cw`.
 * Maps to `lx` in the URL.
 * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
 */
final class X implements ConverterSource
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
