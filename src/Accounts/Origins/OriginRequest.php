<?php

declare(strict_types=1);

namespace Imagekit\Accounts\Origins;

use Imagekit\Accounts\Origins\OriginRequest\AkeneoPim;
use Imagekit\Accounts\Origins\OriginRequest\AzureBlobStorage;
use Imagekit\Accounts\Origins\OriginRequest\CloudinaryBackup;
use Imagekit\Accounts\Origins\OriginRequest\GoogleCloudStorageGcs;
use Imagekit\Accounts\Origins\OriginRequest\S3;
use Imagekit\Accounts\Origins\OriginRequest\S3Compatible;
use Imagekit\Accounts\Origins\OriginRequest\WebFolder;
use Imagekit\Accounts\Origins\OriginRequest\WebProxy;
use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Schema for origin request resources.
 *
 * @phpstan-import-type S3Shape from \Imagekit\Accounts\Origins\OriginRequest\S3
 * @phpstan-import-type S3CompatibleShape from \Imagekit\Accounts\Origins\OriginRequest\S3Compatible
 * @phpstan-import-type CloudinaryBackupShape from \Imagekit\Accounts\Origins\OriginRequest\CloudinaryBackup
 * @phpstan-import-type WebFolderShape from \Imagekit\Accounts\Origins\OriginRequest\WebFolder
 * @phpstan-import-type WebProxyShape from \Imagekit\Accounts\Origins\OriginRequest\WebProxy
 * @phpstan-import-type GoogleCloudStorageGcsShape from \Imagekit\Accounts\Origins\OriginRequest\GoogleCloudStorageGcs
 * @phpstan-import-type AzureBlobStorageShape from \Imagekit\Accounts\Origins\OriginRequest\AzureBlobStorage
 * @phpstan-import-type AkeneoPimShape from \Imagekit\Accounts\Origins\OriginRequest\AkeneoPim
 *
 * @phpstan-type OriginRequestVariants = S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim
 * @phpstan-type OriginRequestShape = OriginRequestVariants|S3Shape|S3CompatibleShape|CloudinaryBackupShape|WebFolderShape|WebProxyShape|GoogleCloudStorageGcsShape|AzureBlobStorageShape|AkeneoPimShape
 */
final class OriginRequest implements ConverterSource
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
        return [
            'S3' => S3::class,
            'S3_COMPATIBLE' => S3Compatible::class,
            'CLOUDINARY_BACKUP' => CloudinaryBackup::class,
            'WEB_FOLDER' => WebFolder::class,
            'WEB_PROXY' => WebProxy::class,
            'GCS' => GoogleCloudStorageGcs::class,
            'AZURE_BLOB' => AzureBlobStorage::class,
            'AKENEO_PIM' => AkeneoPim::class,
        ];
    }
}
