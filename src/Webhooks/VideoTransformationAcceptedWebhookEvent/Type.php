<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const VIDEO_TRANSFORMATION_ACCEPTED = 'video.transformation.accepted';
}
