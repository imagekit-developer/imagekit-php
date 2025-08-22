<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams\Transformation\Post\Abs;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Streaming protocol to use (`hls` or `dash`).
 *
 * @phpstan-type protocol_alias = Protocol::*
 */
final class Protocol implements ConverterSource
{
    use SdkEnum;

    public const HLS = 'hls';

    public const DASH = 'dash';
}
