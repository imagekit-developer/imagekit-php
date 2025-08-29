<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the audio codec, e.g., `aac`, `opus`, or `none`.
 */
final class AudioCodec implements ConverterSource
{
    use SdkEnum;

    public const AAC = 'aac';

    public const OPUS = 'opus';

    public const NONE = 'none';
}
