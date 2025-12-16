<?php

declare(strict_types=1);

namespace Imagekit\Assets;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\Files\File;
use Imagekit\Files\Folder;

/**
 * Object containing details of a file or file version.
 *
 * @phpstan-import-type FileShape from \Imagekit\Files\File
 * @phpstan-import-type FolderShape from \Imagekit\Files\Folder
 *
 * @phpstan-type AssetListResponseItemShape = FileShape|FolderShape
 */
final class AssetListResponseItem implements ConverterSource
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
        return [File::class, 'folder' => Folder::class];
    }
}
