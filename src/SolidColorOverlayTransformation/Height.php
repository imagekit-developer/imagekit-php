<?php

declare(strict_types=1);

namespace Imagekit\SolidColorOverlayTransformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Controls the height of the solid color overlay. Accepts a numeric value or an arithmetic expression.
 * Learn about [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
 *
 * @phpstan-type HeightShape = float|string
 */
final class Height implements ConverterSource
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
