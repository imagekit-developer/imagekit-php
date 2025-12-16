<?php

declare(strict_types=1);

namespace Imagekit\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the height of the output. If a value between 0 and 1 is provided, it is treated as a percentage (e.g., `0.5` represents 50% of the original height).
 * You can also supply arithmetic expressions (e.g., `ih_mul_0.5`).
 * Height transformation – [Images](https://imagekit.io/docs/image-resize-and-crop#height---h) · [Videos](https://imagekit.io/docs/video-resize-and-crop#height---h).
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
