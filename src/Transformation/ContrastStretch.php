<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Automatically enhances the contrast of an image (contrast stretch).
 * See [Contrast Stretch](https://imagekit.io/docs/effects-and-enhancements#contrast-stretch---e-contrast).
 */
final class ContrastStretch implements ConverterSource
{
    use SdkEnum;

    public const TRUE = true;
}
