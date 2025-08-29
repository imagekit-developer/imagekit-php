<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the video codec, e.g., `h264`, `vp9`, `av1`, or `none`.
 */
final class VideoCodec implements ConverterSource
{
    use SdkEnum;

    public const H264 = 'h264';

    public const VP9 = 'vp9';

    public const AV1 = 'av1';

    public const NONE = 'none';
}
