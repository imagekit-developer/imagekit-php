<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\Abs;

/**
 * Streaming protocol to use (`hls` or `dash`).
 */
enum Protocol: string
{
    case HLS = 'hls';

    case DASH = 'dash';
}
