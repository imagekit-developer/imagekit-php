<?php

declare(strict_types=1);

namespace Imagekit\TextOverlayTransformation;

/**
 * Flip/mirror the text horizontally, vertically, or in both directions.
 * Acceptable values: `h` (horizontal), `v` (vertical), `h_v` (horizontal and vertical), or `v_h`.
 */
enum Flip: string
{
    case H = 'h';

    case V = 'v';

    case H_V = 'h_v';

    case V_H = 'v_h';
}
