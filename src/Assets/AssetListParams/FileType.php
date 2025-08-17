<?php

declare(strict_types=1);

namespace ImageKit\Assets\AssetListParams;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter results by file type.
 *
 * - `all` — include all file types
 * - `image` — include only image files
 * - `non-image` — include only non-image files (e.g., JS, CSS, video)
 *
 * @phpstan-type file_type_alias = FileType::*
 */
final class FileType implements ConverterSource
{
    use Enum;

    public const ALL = 'all';

    public const IMAGE = 'image';

    public const NON_IMAGE = 'non-image';
}
