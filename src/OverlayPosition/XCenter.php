<?php

declare(strict_types=1);

namespace Imagekit\OverlayPosition;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the x-coordinate on the base asset where the overlay's center will be positioned.
 * It also accepts arithmetic expressions such as `bw_mul_0.4` or `bw_sub_cw`.
 * Maps to `lxc` in the URL.
 * Cannot be used together with `x`, but can be used with `y`.
 * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
 *
 * @phpstan-type XCenterVariants = float|string
 * @phpstan-type XCenterShape = XCenterVariants
 */
final class XCenter implements ConverterSource
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
