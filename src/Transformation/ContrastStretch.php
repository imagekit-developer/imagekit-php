<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Automatically enhances the contrast of an image (contrast stretch).
 */
final class ContrastStretch implements ConverterSource
{
    use SdkEnum;

    public const TRUE = true;
}
