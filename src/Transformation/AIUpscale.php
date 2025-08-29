<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Upscales images beyond their original dimensions using AI. Not supported inside overlay.
 */
final class AIUpscale implements ConverterSource
{
    use SdkEnum;

    public const TRUE = true;
}
