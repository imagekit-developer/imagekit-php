<?php

declare(strict_types=1);

namespace ImageKit\Assets\AssetListParams;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter results by file type.
 *
 * - `all` — include all file types
 * - `image` — include only image files
 * - `non-image` — include only non-image files (e.g., JS, CSS, video)
 */
final class FileType implements ConverterSource
{
    use SdkEnum;

    public const ALL = 'all';

    public const IMAGE = 'image';

    public const NON_IMAGE = 'non-image';
}
