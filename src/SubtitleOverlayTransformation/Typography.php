<?php

declare(strict_types=1);

namespace ImageKit\SubtitleOverlayTransformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Typography style for subtitles.
 */
final class Typography implements ConverterSource
{
    use SdkEnum;

    public const B = 'b';

    public const I = 'i';

    public const B_I = 'b_i';
}
