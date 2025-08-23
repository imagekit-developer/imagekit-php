<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data\Transformation\Options;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class VideoCodec implements ConverterSource
{
    use SdkEnum;

    public const H264 = 'h264';

    public const VP9 = 'vp9';
}
