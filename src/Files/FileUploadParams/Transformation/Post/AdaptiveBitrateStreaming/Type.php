<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Adaptive Bitrate Streaming (ABS) setup.
 *
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const ABS = 'abs';
}
