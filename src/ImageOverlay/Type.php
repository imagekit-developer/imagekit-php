<?php

declare(strict_types=1);

namespace ImageKit\ImageOverlay;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class Type implements ConverterSource
{
    use SdkEnum;

    public const IMAGE = 'image';
}
