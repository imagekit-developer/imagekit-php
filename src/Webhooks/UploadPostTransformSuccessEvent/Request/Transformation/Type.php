<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPostTransformSuccessEvent\Request\Transformation;

/**
 * Type of the requested post-transformation.
 */
enum Type: string
{
    case TRANSFORMATION = 'transformation';

    case ABS = 'abs';

    case GIF_TO_VIDEO = 'gif-to-video';

    case THUMBNAIL = 'thumbnail';
}
