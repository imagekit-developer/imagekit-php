<?php

declare(strict_types=1);

namespace ImageKit;

/**
 * Available streaming resolutions for [adaptive bitrate streaming](https://imagekit.io/docs/adaptive-bitrate-streaming).
 */
enum StreamingResolution: string
{
    case STREAMING_RESOLUTION_240 = '240';

    case STREAMING_RESOLUTION_360 = '360';

    case STREAMING_RESOLUTION_480 = '480';

    case STREAMING_RESOLUTION_720 = '720';

    case STREAMING_RESOLUTION_1080 = '1080';

    case STREAMING_RESOLUTION_1440 = '1440';

    case STREAMING_RESOLUTION_2160 = '2160';
}
