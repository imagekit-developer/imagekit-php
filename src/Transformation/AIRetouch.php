<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Performs AI-based retouching to improve faces or product shots. Not supported inside overlay.
 * See [AI Retouch](https://imagekit.io/docs/ai-transformations#retouch-e-retouch).
 */
final class AIRetouch implements ConverterSource
{
    use SdkEnum;

    public const TRUE = true;
}
