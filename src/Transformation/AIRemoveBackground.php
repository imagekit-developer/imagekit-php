<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Applies ImageKit's in-house background removal.
 * Supported inside overlay.
 * See [AI Background Removal](https://imagekit.io/docs/ai-transformations#imagekit-background-removal-e-bgremove).
 */
final class AIRemoveBackground implements ConverterSource
{
    use SdkEnum;

    public const TRUE = true;
}
