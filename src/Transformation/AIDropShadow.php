<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Adds an AI-based drop shadow around a foreground object on a transparent or removed background.
 * Optionally, control the direction, elevation, and saturation of the light source (e.g., `az-45` to change light direction).
 * Pass `true` for the default drop shadow, or provide a string for a custom drop shadow.
 * Supported inside overlay.
 * See [AI Drop Shadow](https://imagekit.io/docs/ai-transformations#ai-drop-shadow-e-dropshadow).
 */
final class AIDropShadow implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return ['bool', 'string'];
    }
}
