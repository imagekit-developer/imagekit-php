<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Adds a shadow beneath solid objects in an image with a transparent background.
 * For AI-based drop shadows, refer to aiDropShadow.
 * Pass `true` for a default shadow, or provide a string for a custom shadow.
 * See [Shadow](https://imagekit.io/docs/effects-and-enhancements#shadow---e-shadow).
 */
final class Shadow implements ConverterSource
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
