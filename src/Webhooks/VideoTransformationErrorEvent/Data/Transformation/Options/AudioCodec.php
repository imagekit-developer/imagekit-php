<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Options;

/**
 * Audio codec used for encoding (aac or opus).
 */
enum AudioCodec: string
{
    case AAC = 'aac';

    case OPUS = 'opus';
}
