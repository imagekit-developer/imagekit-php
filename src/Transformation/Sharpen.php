<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Sharpens the input image, highlighting edges and finer details.
 * Pass `true` for default sharpening, or provide a numeric value for custom sharpening.
 * See [Sharpen](https://imagekit.io/docs/effects-and-enhancements#sharpen---e-sharpen).
 */
final class Sharpen implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [STAINLESS_FIXME_::class, 'float'];
    }
}
