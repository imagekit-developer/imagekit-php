<?php

declare(strict_types=1);

namespace ImageKit\OverlayPosition;

/**
 * Specifies the position of the overlay relative to the parent image or video.
 * If one or more of `x`, `y`, `xCenter`, or `yCenter` parameters are specified, this parameter is ignored.
 * Maps to `lfo` in the URL.
 */
enum Focus: string
{
    case CENTER = 'center';

    case TOP = 'top';

    case LEFT = 'left';

    case BOTTOM = 'bottom';

    case RIGHT = 'right';

    case TOP_LEFT = 'top_left';

    case TOP_RIGHT = 'top_right';

    case BOTTOM_LEFT = 'bottom_left';

    case BOTTOM_RIGHT = 'bottom_right';
}
