<?php

declare(strict_types=1);

namespace Imagekit\Assets\AssetListParams;

/**
 * Filter results by asset type.
 *
 * - `file` — returns only files
 * - `file-version` — returns specific file versions
 * - `folder` — returns only folders
 * - `all` — returns both files and folders (excludes `file-version`)
 */
enum Type: string
{
    case FILE = 'file';

    case FILE_VERSION = 'file-version';

    case FOLDER = 'folder';

    case ALL = 'all';
}
