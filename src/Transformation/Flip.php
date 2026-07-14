<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

/**
 * Flips or mirrors an image either horizontally, vertically, or both.
 * Acceptable values: `h` (horizontal), `v` (vertical), `h_v` (horizontal and vertical), or `v_h`.
 * See [Flip](https://imagekit.io/docs/effects-and-enhancements#flip---fl).
 */
enum Flip: string
{
    case H = 'h';

    case V = 'v';

    case H_V = 'h_v';

    case V_H = 'v_h';
}
