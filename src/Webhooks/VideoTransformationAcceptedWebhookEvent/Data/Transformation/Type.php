<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const VIDEO_TRANSFORMATION = 'video-transformation';

    public const GIF_TO_VIDEO = 'gif-to-video';

    public const VIDEO_THUMBNAIL = 'video-thumbnail';
}
