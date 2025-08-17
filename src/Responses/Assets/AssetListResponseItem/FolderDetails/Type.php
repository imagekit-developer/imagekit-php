<?php

declare(strict_types=1);

namespace ImageKit\Responses\Assets\AssetListResponseItem\FolderDetails;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Type of the asset.
 *
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const FOLDER = 'folder';
}
