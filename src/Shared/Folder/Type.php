<?php

declare(strict_types=1);

namespace ImageKit\Shared\Folder;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Type of the asset.
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const FOLDER = 'folder';
}
