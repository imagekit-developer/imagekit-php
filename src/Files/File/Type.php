<?php

declare(strict_types=1);

namespace ImageKit\Files\File;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Type of the asset.
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const FILE = 'file';

    public const FILE_VERSION = 'file-version';
}
