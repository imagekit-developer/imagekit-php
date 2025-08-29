<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Available streaming resolutions for adaptive bitrate streaming.
 */
final class StreamingResolution implements ConverterSource
{
    use SdkEnum;

    public const STREAMING_RESOLUTION_240 = '240';

    public const STREAMING_RESOLUTION_360 = '360';

    public const STREAMING_RESOLUTION_480 = '480';

    public const STREAMING_RESOLUTION_720 = '720';

    public const STREAMING_RESOLUTION_1080 = '1080';

    public const STREAMING_RESOLUTION_1440 = '1440';

    public const STREAMING_RESOLUTION_2160 = '2160';
}
