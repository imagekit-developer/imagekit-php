<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Files\File;
use ImageKit\Files\Folder;

/**
 * Object containing details of a file or file version.
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
