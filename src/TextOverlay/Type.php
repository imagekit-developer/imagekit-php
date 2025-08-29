<?php

declare(strict_types=1);

namespace ImageKit\TextOverlay;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class Type implements ConverterSource
{
    use SdkEnum;

    public const TEXT = 'text';
}
