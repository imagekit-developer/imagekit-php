<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationAcceptedEvent\Data\Transformation\Options;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Streaming protocol for adaptive bitrate streaming.
 */
final class StreamProtocol implements ConverterSource
{
    use SdkEnum;

    public const HLS = 'HLS';

    public const DASH = 'DASH';
}
