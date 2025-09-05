<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Core\Conversion\EnumOf;

/**
 * Applies Unsharp Masking (USM), an image sharpening technique.
 * Pass `true` for a default unsharp mask, or provide a string for a custom unsharp mask.
 * See [Unsharp Mask](https://imagekit.io/docs/effects-and-enhancements#unsharp-mask---e-usm).
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
        return [new EnumOf([true]), 'string'];
    }
}
