<?php

declare(strict_types=1);

namespace ImageKit;

/**
 * Available streaming resolutions for [adaptive bitrate streaming](https://imagekit.io/docs/adaptive-bitrate-streaming).
 */
enum StreamingResolution: string
{
    case _240 = '240';

    case _360 = '360';

    case _480 = '480';

    case _720 = '720';

    case _1080 = '1080';

    case _1440 = '1440';

    case _2160 = '2160';
}
