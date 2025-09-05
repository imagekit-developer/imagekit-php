<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Core\Conversion\EnumOf;

/**
 * Creates a linear gradient with two colors. Pass `true` for a default gradient, or provide a string for a custom gradient.
 * See [Gradient](https://imagekit.io/docs/effects-and-enhancements#gradient---e-gradient).
 */
final class Gradient implements ConverterSource
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
