<?php

declare(strict_types=1);

namespace Imagekit\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Sharpens the input image, highlighting edges and finer details.
 * Pass `true` for default sharpening, or provide a numeric value for custom sharpening.
 * See [Sharpen](https://imagekit.io/docs/effects-and-enhancements#sharpen---e-sharpen).
 *
 * @phpstan-type SharpenShape = float|bool
 */
final class Sharpen implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['bool', 'float'];
    }
}
