<?php

declare(strict_types=1);

namespace Imagekit\Accounts\Origins;

use Imagekit\Accounts\Origins\OriginRequest\AkeneoPim;
use Imagekit\Accounts\Origins\OriginRequest\AzureBlob;
use Imagekit\Accounts\Origins\OriginRequest\CloudinaryBackup;
use Imagekit\Accounts\Origins\OriginRequest\Gcs;
use Imagekit\Accounts\Origins\OriginRequest\S3;
use Imagekit\Accounts\Origins\OriginRequest\S3Compatible;
use Imagekit\Accounts\Origins\OriginRequest\WebFolder;
use Imagekit\Accounts\Origins\OriginRequest\WebProxy;
use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

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
            'GCS' => Gcs::class,
            'AZURE_BLOB' => AzureBlob::class,
            'AKENEO_PIM' => AkeneoPim::class,
        ];
    }
}
