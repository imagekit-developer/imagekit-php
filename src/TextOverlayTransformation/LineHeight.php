<?php

declare(strict_types=1);

namespace ImageKit\TextOverlayTransformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the line height for multi-line text overlays. It will come into effect only if the text wraps over multiple lines.
 * Accepts either an integer value or an arithmetic expression.
 *
 * @phpstan-type LineHeightVariants = float|string
 * @phpstan-type LineHeightShape = LineHeightVariants
 */
final class LineHeight implements ConverterSource
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
