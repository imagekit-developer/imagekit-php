<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPostTransformErrorEvent\Request\Transformation;

/**
 * Only applicable if transformation type is 'abs'. Streaming protocol used.
 */
enum Protocol: string
{
    case HLS = 'hls';

    case DASH = 'dash';
}
