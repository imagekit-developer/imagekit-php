<?php

declare(strict_types=1);

namespace Imagekit\SolidColorOverlayTransformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Creates a linear gradient with two colors. Pass `true` for a default gradient, or provide a string for a custom gradient.
 * Only works if the base asset is an image. See [gradient](https://imagekit.io/docs/effects-and-enhancements#gradient---e-gradient).
 *
 * @phpstan-type GradientShape = string|bool
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
