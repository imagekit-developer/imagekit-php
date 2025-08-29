<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Transformation\Trim\UnionMember0;

/**
 * Useful for images with a solid or nearly solid background and a central object. This parameter trims the background,
 * leaving only the central object in the output image.
 */
final class Trim implements ConverterSource
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
