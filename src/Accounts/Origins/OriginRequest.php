<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins;

use ImageKit\Accounts\Origins\OriginRequest\AkeneoPim;
use ImageKit\Accounts\Origins\OriginRequest\AzureBlob;
use ImageKit\Accounts\Origins\OriginRequest\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginRequest\Gcs;
use ImageKit\Accounts\Origins\OriginRequest\S3;
use ImageKit\Accounts\Origins\OriginRequest\S3Compatible;
use ImageKit\Accounts\Origins\OriginRequest\WebFolder;
use ImageKit\Accounts\Origins\OriginRequest\WebProxy;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Schema for origin request resources.
 */
final class OriginRequest implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [
            'S3' => S3::class,
            'S3_COMPATIBLE' => S3Compatible::class,
            'CLOUDINARY_BACKUP' => CloudinaryBackup::class,
            'WEB_FOLDER' => WebFolder::class,
            'WEB_PROXY' => WebProxy::class,
            'GCS' => Gcs::class,
            'AZURE_BLOB' => AzureBlob::class,
            'AKENEO_PIM' => AkeneoPim::class,
        ];
    }
}
