<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Enables a grayscale effect for images. See [Grayscale](https://imagekit.io/docs/effects-and-enhancements#grayscale---e-grayscale).
 */
final class Grayscale implements ConverterSource
{
    use SdkEnum;

    public const TRUE = true;
}
