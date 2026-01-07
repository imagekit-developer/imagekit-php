<?php

declare(strict_types=1);

namespace Imagekit\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Creates a linear gradient with two colors. Pass `true` for a default gradient, or provide a string for a custom gradient.
 * See [Gradient](https://imagekit.io/docs/effects-and-enhancements#gradient---e-gradient).
 *
 * @phpstan-type GradientVariants = string|bool
 * @phpstan-type GradientShape = GradientVariants
 */
final class Gradient implements ConverterSource
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
