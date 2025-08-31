<?php

declare(strict_types=1);

namespace ImageKit\SubtitleOverlayTransformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Sets the typography style of the subtitle text. Supports values are `b` for bold, `i` for italics, and `b_i` for bold with italics.
 *
 * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
 */
final class Typography implements ConverterSource
{
    use SdkEnum;

    public const B = 'b';

    public const I = 'i';

    public const B_I = 'b_i';
}
