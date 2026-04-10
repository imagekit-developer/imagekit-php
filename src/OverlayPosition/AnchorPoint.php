<?php

declare(strict_types=1);

namespace Imagekit\OverlayPosition;

/**
 * Sets the anchor point on the base asset from which the overlay offset is calculated.
 * The default value is `top_left`.
 * Maps to `lap` in the URL.
 * Can only be used with one or more of `x`, `y`, `xCenter`, or `yCenter`.
 */
enum AnchorPoint: string
{
    case TOP = 'top';

    case LEFT = 'left';

    case RIGHT = 'right';

    case BOTTOM = 'bottom';

    case TOP_LEFT = 'top_left';

    case TOP_RIGHT = 'top_right';

    case BOTTOM_LEFT = 'bottom_left';

    case BOTTOM_RIGHT = 'bottom_right';

    case CENTER = 'center';
}
