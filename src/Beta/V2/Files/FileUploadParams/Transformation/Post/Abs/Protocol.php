<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\Abs;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Streaming protocol to use (`hls` or `dash`).
 */
final class Protocol implements ConverterSource
{
    use SdkEnum;

    public const HLS = 'hls';

    public const DASH = 'dash';
}
