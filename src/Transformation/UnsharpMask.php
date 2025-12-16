<?php

declare(strict_types=1);

namespace Imagekit\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Applies Unsharp Masking (USM), an image sharpening technique.
 * Pass `true` for a default unsharp mask, or provide a string for a custom unsharp mask.
 * See [Unsharp Mask](https://imagekit.io/docs/effects-and-enhancements#unsharp-mask---e-usm).
 *
 * @phpstan-type UnsharpMaskShape = string|bool
 */
final class UnsharpMask implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['bool', 'string'];
    }
}
