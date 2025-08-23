<?php

declare(strict_types=1);

namespace ImageKit\Assets\AssetListParams;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter results by asset type.
 *
 * - `file` — returns only files
 * - `file-version` — returns specific file versions
 * - `folder` — returns only folders
 * - `all` — returns both files and folders (excludes `file-version`)
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const FILE = 'file';

    public const FILE_VERSION = 'file-version';

    public const FOLDER = 'folder';

    public const ALL = 'all';
}
