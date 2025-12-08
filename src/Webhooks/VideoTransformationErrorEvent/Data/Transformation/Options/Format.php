<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Options;

/**
 * Output format for the transformed video or thumbnail.
 */
enum Format: string
{
    case MP4 = 'mp4';

    case WEBM = 'webm';

    case JPG = 'jpg';

    case PNG = 'png';

    case WEBP = 'webp';
}
