<?php

declare(strict_types=1);

namespace ImageKit\OverlayPosition;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the position of the overlay relative to the parent image or video.
 * Maps to `lfo` in the URL.
 */
final class Focus implements ConverterSource
{
    use SdkEnum;

    public const CENTER = 'center';

    public const TOP = 'top';

    public const LEFT = 'left';

    public const BOTTOM = 'bottom';

    public const RIGHT = 'right';

    public const TOP_LEFT = 'top_left';

    public const TOP_RIGHT = 'top_right';

    public const BOTTOM_LEFT = 'bottom_left';

    public const BOTTOM_RIGHT = 'bottom_right';
}
