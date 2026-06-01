<?php

declare(strict_types=1);

namespace ImageKit\Assets\UploadRequest\Transformation\Post\AdaptiveBitrateStreaming;

/**
 * Streaming protocol to use (`hls` or `dash`).
 */
enum Protocol: string
{
    case HLS = 'hls';

    case DASH = 'dash';
}
