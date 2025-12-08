<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\Abs;

/**
 * Streaming protocol to use (`hls` or `dash`).
 */
enum Protocol: string
{
    case HLS = 'hls';

    case DASH = 'dash';
}
