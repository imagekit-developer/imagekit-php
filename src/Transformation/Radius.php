<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Transformation\Radius\UnionMember1;

/**
 * Specifies the corner radius for rounded corners (e.g., 20) or `max` for circular/oval shapes.
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
