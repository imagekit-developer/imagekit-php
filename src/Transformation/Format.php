<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

/**
 * Specifies the output format for images or videos, e.g., `jpg`, `png`, `webp`, `mp4`, or `auto`.
 * You can also pass `orig` for images to return the original format.
 * ImageKit automatically delivers images and videos in the optimal format based on device support unless overridden by the dashboard settings or the format parameter.
 * See [Image format](https://imagekit.io/docs/image-optimization#format---f) and [Video format](https://imagekit.io/docs/video-optimization#format---f).
 */
enum Format: string
{
    case AUTO = 'auto';

    case WEBP = 'webp';

    case JPG = 'jpg';

    case JPEG = 'jpeg';

    case PNG = 'png';

    case GIF = 'gif';

    case SVG = 'svg';

    case MP4 = 'mp4';

    case WEBM = 'webm';

    case AVIF = 'avif';

    case ORIG = 'orig';
}
