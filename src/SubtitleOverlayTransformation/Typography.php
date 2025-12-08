<?php

declare(strict_types=1);

namespace Imagekit\SubtitleOverlayTransformation;

/**
 * Sets the typography style of the subtitle text. Supports values are `b` for bold, `i` for italics, and `b_i` for bold with italics.
 *
 * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
 */
enum Typography: string
{
    case B = 'b';

    case I = 'i';

    case B_I = 'b_i';
}
