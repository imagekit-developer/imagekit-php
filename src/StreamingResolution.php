<?php

declare(strict_types=1);

namespace ImageKit;

/**
 * Available streaming resolutions for [adaptive bitrate streaming](https://imagekit.io/docs/adaptive-bitrate-streaming).
 */
enum StreamingResolution: string
{
    case RESOLUTION240P = '240';

    case RESOLUTION360P = '360';

    case RESOLUTION480P = '480';

    case RESOLUTION720P = '720';

    case RESOLUTION1080P = '1080';

    case RESOLUTION1440P = '1440';

    case RESOLUTION2160P = '2160';
}
