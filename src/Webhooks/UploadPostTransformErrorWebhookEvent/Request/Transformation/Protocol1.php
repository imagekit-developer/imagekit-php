<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPostTransformErrorWebhookEvent\Request\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Only applicable if transformation type is 'abs'. Streaming protocol used.
 */
final class Protocol implements ConverterSource
{
    use SdkEnum;

    public const HLS = 'hls';

    public const DASH = 'dash';
}
