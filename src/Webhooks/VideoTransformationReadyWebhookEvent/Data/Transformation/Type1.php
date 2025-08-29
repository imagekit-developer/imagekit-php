<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyWebhookEvent\Data\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class Type implements ConverterSource
{
    use SdkEnum;

    public const VIDEO_TRANSFORMATION = 'video-transformation';

    public const GIF_TO_VIDEO = 'gif-to-video';

    public const VIDEO_THUMBNAIL = 'video-thumbnail';
}
