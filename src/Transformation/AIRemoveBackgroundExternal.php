<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Uses third-party background removal.
 * Note: It is recommended to use aiRemoveBackground, ImageKit's in-house solution, which is more cost-effective.
 * Supported inside overlay.
 * See [External Background Removal](https://imagekit.io/docs/ai-transformations#background-removal-e-removedotbg).
 */
final class AIRemoveBackgroundExternal implements ConverterSource
{
    use SdkEnum;

    public const TRUE = true;
}
