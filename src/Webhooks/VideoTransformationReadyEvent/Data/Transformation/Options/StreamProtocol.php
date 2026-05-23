<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Options;

/**
 * Streaming protocol for adaptive bitrate streaming.
 */
enum StreamProtocol: string
{
    case HLS = 'HLS';

    case DASH = 'DASH';
}
