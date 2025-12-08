<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationErrorEvent\Data\Transformation;

/**
 * Type of video transformation:
 * - `video-transformation`: Standard video processing (resize, format conversion, etc.)
 * - `gif-to-video`: Convert animated GIF to video format
 * - `video-thumbnail`: Generate thumbnail image from video
 */
enum Type: string
{
    case VIDEO_TRANSFORMATION = 'video-transformation';

    case GIF_TO_VIDEO = 'gif-to-video';

    case VIDEO_THUMBNAIL = 'video-thumbnail';
}
