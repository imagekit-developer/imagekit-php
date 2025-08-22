<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyWebhookEvent;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const VIDEO_TRANSFORMATION_READY = 'video.transformation.ready';
}
