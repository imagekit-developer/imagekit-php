<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationErrorEvent\Data\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Type of video transformation:
 * - `video-transformation`: Standard video processing (resize, format conversion, etc.)
 * - `gif-to-video`: Convert animated GIF to video format
 * - `video-thumbnail`: Generate thumbnail image from video
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const VIDEO_TRANSFORMATION = 'video-transformation';

    public const GIF_TO_VIDEO = 'gif-to-video';

    public const VIDEO_THUMBNAIL = 'video-thumbnail';
}
