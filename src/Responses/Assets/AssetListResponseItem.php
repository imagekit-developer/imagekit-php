<?php

declare(strict_types=1);

namespace ImageKit\Responses\Assets;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Responses\Assets\AssetListResponseItem\FileDetails;
use ImageKit\Responses\Assets\AssetListResponseItem\FolderDetails;

/**
 * Object containing details of a file or file version.
 *
 * @phpstan-type asset_list_response_item_alias = FileDetails|FolderDetails
 */
final class AssetListResponseItem implements ConverterSource
{
    use SdkUnion;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return [FileDetails::class, FolderDetails::class];
    }
}
