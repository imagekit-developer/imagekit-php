<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationAcceptedEvent\Data\Transformation\Options;

/**
 * Video codec used for encoding (h264, vp9, or av1).
 */
enum VideoCodec: string
{
    case H264 = 'h264';

    case VP9 = 'vp9';

    case AV1 = 'av1';
}
