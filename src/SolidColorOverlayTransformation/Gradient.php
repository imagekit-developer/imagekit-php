<?php

declare(strict_types=1);

namespace ImageKit\SolidColorOverlayTransformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\SolidColorOverlayTransformation\Gradient\UnionMember0;

/**
 * Gradient effect for the overlay.
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
        return [UnionMember0::class, 'string'];
    }
}
