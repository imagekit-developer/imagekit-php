<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Applies ImageKit's in-house background removal.
 * Supported inside overlay.
 */
final class AIRemoveBackground implements ConverterSource
{
    use SdkEnum;

    public const TRUE = true;
}
