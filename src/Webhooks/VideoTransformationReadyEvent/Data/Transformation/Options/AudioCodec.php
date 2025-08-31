<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Options;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Audio codec used for encoding (aac or opus).
 */
final class AudioCodec implements ConverterSource
{
    use SdkEnum;

    public const AAC = 'aac';

    public const OPUS = 'opus';
}
