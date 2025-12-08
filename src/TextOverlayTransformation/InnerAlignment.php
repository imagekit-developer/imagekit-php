<?php

declare(strict_types=1);

namespace Imagekit\TextOverlayTransformation;

/**
 * Specifies the inner alignment of the text when width is more than the text length.
 */
enum InnerAlignment: string
{
    case LEFT = 'left';

    case RIGHT = 'right';

    case CENTER = 'center';
}
