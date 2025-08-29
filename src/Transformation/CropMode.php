<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Additional crop modes for image resizing.
 */
final class CropMode implements ConverterSource
{
    use SdkEnum;

    public const PAD_RESIZE = 'pad_resize';

    public const EXTRACT = 'extract';

    public const PAD_EXTRACT = 'pad_extract';
}
