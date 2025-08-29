<?php

declare(strict_types=1);

namespace ImageKit\SolidColorOverlayTransformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\SolidColorOverlayTransformation\Radius\UnionMember1;

/**
 * Corner radius of the solid color overlay.
 */
final class Radius implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return ['float', UnionMember1::class];
    }
}
