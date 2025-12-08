<?php

declare(strict_types=1);

namespace Imagekit\OverlayPosition;

/**
 * Specifies the position of the overlay relative to the parent image or video.
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
