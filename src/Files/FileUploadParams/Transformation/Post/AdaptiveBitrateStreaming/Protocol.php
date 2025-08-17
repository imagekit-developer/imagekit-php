<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Streaming protocol to use (`hls` or `dash`).
 *
 * @phpstan-type protocol_alias = Protocol::*
 */
final class Protocol implements ConverterSource
{
    use Enum;

    public const HLS = 'hls';

    public const DASH = 'dash';
}
