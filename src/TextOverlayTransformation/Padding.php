<?php

declare(strict_types=1);

namespace Imagekit\TextOverlayTransformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the padding around the overlaid text.
 * Can be provided as a single positive integer or multiple values separated by underscores (following CSS shorthand order).
 * Arithmetic expressions are also accepted.
 *
 * @phpstan-type PaddingVariants = float|string
 * @phpstan-type PaddingShape = PaddingVariants
 */
final class Padding implements ConverterSource
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
