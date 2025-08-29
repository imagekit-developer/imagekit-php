<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Transformation\UnsharpMask\UnionMember0;

/**
 * Applies Unsharp Masking (USM), an image sharpening technique.
 * Pass `true` for a default unsharp mask, or provide a string for a custom unsharp mask.
 */
final class UnsharpMask implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [UnionMember0::class, 'string'];
    }
}
