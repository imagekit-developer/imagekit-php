<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

/**
 * Specifies the video codec, e.g., `h264`, `vp9`, `av1`, or `none`. See [Video codec](https://imagekit.io/docs/video-optimization#video-codec---vc).
 */
enum VideoCodec: string
{
    case H264 = 'h264';

    case VP9 = 'vp9';

    case AV1 = 'av1';

    case NONE = 'none';
}
