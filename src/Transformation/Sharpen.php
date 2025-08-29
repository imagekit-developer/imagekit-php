<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Transformation\Sharpen\UnionMember0;

/**
 * Sharpens the input image, highlighting edges and finer details.
 * Pass `true` for default sharpening, or provide a numeric value for custom sharpening.
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
        return [UnionMember0::class, 'float'];
    }
}
