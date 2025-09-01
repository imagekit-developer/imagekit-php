<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the output format for images or videos, e.g., `jpg`, `png`, `webp`, `mp4`, or `auto`.
 * You can also pass `orig` for images to return the original format.
 * ImageKit automatically delivers images and videos in the optimal format based on device support unless overridden by the dashboard settings or the format parameter.
 * See [Image format](https://imagekit.io/docs/image-optimization#format---f) and [Video format](https://imagekit.io/docs/video-optimization#format---f).
 */
final class Format implements ConverterSource
{
    use SdkEnum;

    public const AUTO = 'auto';

    public const WEBP = 'webp';

    public const JPG = 'jpg';

    public const JPEG = 'jpeg';

    public const PNG = 'png';

    public const GIF = 'gif';

    public const SVG = 'svg';

    public const MP4 = 'mp4';

    public const WEBM = 'webm';

    public const AVIF = 'avif';

    public const ORIG = 'orig';
}
