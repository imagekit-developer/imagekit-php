<?php

declare(strict_types=1);

namespace ImageKit\TextOverlayTransformation;

/**
 * Flip the text overlay horizontally, vertically, or both.
 */
enum Flip: string
{
    case H = 'h';

    case V = 'v';

    case H_V = 'h_v';

    case V_H = 'v_h';
}
