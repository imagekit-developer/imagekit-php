<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams\Transformation\Post\ConvertGifToVideo;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Converts an animated GIF into an MP4.
 *
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const GIF_TO_VIDEO = 'gif-to-video';
}
