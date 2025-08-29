<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data\Transformation\Options;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class AudioCodec implements ConverterSource
{
    use SdkEnum;

    public const AAC = 'aac';

    public const OPUS = 'opus';
}
