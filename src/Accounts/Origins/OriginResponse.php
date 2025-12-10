<?php

declare(strict_types=1);

namespace Imagekit\Accounts\Origins;

use Imagekit\Accounts\Origins\OriginResponse\AkeneoPim;
use Imagekit\Accounts\Origins\OriginResponse\AzureBlobStorage;
use Imagekit\Accounts\Origins\OriginResponse\CloudinaryBackup;
use Imagekit\Accounts\Origins\OriginResponse\GoogleCloudStorageGcs;
use Imagekit\Accounts\Origins\OriginResponse\S3;
use Imagekit\Accounts\Origins\OriginResponse\S3Compatible;
use Imagekit\Accounts\Origins\OriginResponse\WebFolder;
use Imagekit\Accounts\Origins\OriginResponse\WebProxy;
use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Origin object as returned by the API (sensitive fields removed).
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
