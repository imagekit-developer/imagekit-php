<?php

declare(strict_types=1);

namespace ImageKit\SubtitleOverlay;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class Type implements ConverterSource
{
    use SdkEnum;

    public const SUBTITLE = 'subtitle';
}
