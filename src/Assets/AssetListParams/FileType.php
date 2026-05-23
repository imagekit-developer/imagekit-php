<?php

declare(strict_types=1);

namespace ImageKit\Assets\AssetListParams;

/**
 * Filter results by file type.
 *
 * - `all` — include all file types
 * - `image` — include only image files
 * - `non-image` — include only non-image files (e.g., JS, CSS, video)
 */
enum FileType: string
{
    case ALL = 'all';

    case IMAGE = 'image';

    case NON_IMAGE = 'non-image';
}
