<?php

declare(strict_types=1);

namespace ImageKit\Files\FileListParams;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Limit search to one of `file`, `file-version`, or `folder`. Pass `all` to include `files` and `folders` in search results (`file-version` will not be included in this case).
 *
 * Default value - `file`
 *
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const FILE = 'file';

    public const FILE_VERSION = 'file-version';

    public const FOLDER = 'folder';

    public const ALL = 'all';
}
