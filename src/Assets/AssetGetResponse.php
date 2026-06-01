<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Object containing details of a file.
 *
 * @phpstan-import-type FileDetailsShape from \ImageKit\Assets\FileDetails
 * @phpstan-import-type FolderDetailsShape from \ImageKit\Assets\FolderDetails
 *
 * @phpstan-type AssetGetResponseVariants = FileDetails|FolderDetails
 * @phpstan-type AssetGetResponseShape = AssetGetResponseVariants|FileDetailsShape|FolderDetailsShape
 */
final class AssetGetResponse implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['file' => FileDetails::class, 'folder' => FolderDetails::class];
    }
}
