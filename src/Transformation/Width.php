<?php

declare(strict_types=1);

namespace Imagekit\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the width of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.4` represents 40% of the original width).
 * You can also supply arithmetic expressions (e.g., `iw_div_2`).
 * Width transformation – [Images](https://imagekit.io/docs/image-resize-and-crop#width---w) · [Videos](https://imagekit.io/docs/video-resize-and-crop#width---w).
 *
 * @phpstan-type WidthVariants = float|string
 * @phpstan-type WidthShape = WidthVariants
 */
final class Width implements ConverterSource
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
