<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Upscales images beyond their original dimensions using AI. Not supported inside overlay.
 * See [AI Upscale](https://imagekit.io/docs/ai-transformations#upscale-e-upscale).
 */
final class AIUpscale implements ConverterSource
{
    use SdkEnum;

    public const TRUE = true;
}
