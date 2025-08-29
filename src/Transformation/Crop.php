<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Crop modes for image resizing.
 */
final class Crop implements ConverterSource
{
    use SdkEnum;

    public const FORCE = 'force';

    public const AT_MAX = 'at_max';

    public const AT_MAX_ENLARGE = 'at_max_enlarge';

    public const AT_LEAST = 'at_least';

    public const MAINTAIN_RATIO = 'maintain_ratio';
}
