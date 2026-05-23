<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins;

use ImageKit\Accounts\Origins\OriginResponse\AkeneoPim;
use ImageKit\Accounts\Origins\OriginResponse\AzureBlobStorage;
use ImageKit\Accounts\Origins\OriginResponse\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginResponse\GoogleCloudStorageGcs;
use ImageKit\Accounts\Origins\OriginResponse\S3;
use ImageKit\Accounts\Origins\OriginResponse\S3Compatible;
use ImageKit\Accounts\Origins\OriginResponse\WebFolder;
use ImageKit\Accounts\Origins\OriginResponse\WebProxy;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Origin object as returned by the API (sensitive fields removed).
 *
 * @phpstan-import-type S3Shape from \ImageKit\Accounts\Origins\OriginResponse\S3
 * @phpstan-import-type S3CompatibleShape from \ImageKit\Accounts\Origins\OriginResponse\S3Compatible
 * @phpstan-import-type CloudinaryBackupShape from \ImageKit\Accounts\Origins\OriginResponse\CloudinaryBackup
 * @phpstan-import-type WebFolderShape from \ImageKit\Accounts\Origins\OriginResponse\WebFolder
 * @phpstan-import-type WebProxyShape from \ImageKit\Accounts\Origins\OriginResponse\WebProxy
 * @phpstan-import-type GoogleCloudStorageGcsShape from \ImageKit\Accounts\Origins\OriginResponse\GoogleCloudStorageGcs
 * @phpstan-import-type AzureBlobStorageShape from \ImageKit\Accounts\Origins\OriginResponse\AzureBlobStorage
 * @phpstan-import-type AkeneoPimShape from \ImageKit\Accounts\Origins\OriginResponse\AkeneoPim
 *
 * @phpstan-type OriginResponseVariants = S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim
 * @phpstan-type OriginResponseShape = OriginResponseVariants|S3Shape|S3CompatibleShape|CloudinaryBackupShape|WebFolderShape|WebProxyShape|GoogleCloudStorageGcsShape|AzureBlobStorageShape|AkeneoPimShape
 */
final class OriginResponse implements ConverterSource
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
