<?php

declare(strict_types=1);

namespace Imagekit\TextOverlayTransformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the font size of the overlaid text. Accepts a numeric value or an arithmetic expression.
 *
 * @phpstan-type FontSizeVariants = float|string
 * @phpstan-type FontSizeShape = FontSizeVariants
 */
final class FontSize implements ConverterSource
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
