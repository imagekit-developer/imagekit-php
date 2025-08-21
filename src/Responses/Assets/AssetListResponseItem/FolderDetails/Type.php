<?php

declare(strict_types=1);

namespace ImageKit\Responses\Assets\AssetListResponseItem\FolderDetails;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Type of the asset.
 *
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const FOLDER = 'folder';
}
