<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Options;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Video codec used for encoding (h264, vp9, or av1).
 */
final class VideoCodec implements ConverterSource
{
    use SdkEnum;

    public const H264 = 'h264';

    public const VP9 = 'vp9';

    public const AV1 = 'av1';
}
