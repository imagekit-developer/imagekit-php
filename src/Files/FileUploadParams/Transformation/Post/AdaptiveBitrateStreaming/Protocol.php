<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming;

/**
 * Streaming protocol to use (`hls` or `dash`).
 */
enum Protocol: string
{
    case HLS = 'hls';

    case DASH = 'dash';
}
