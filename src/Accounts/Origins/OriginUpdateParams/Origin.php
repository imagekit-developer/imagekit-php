<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginUpdateParams;

use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\AkeneoPim;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\AzureBlobStorage;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\GoogleCloudStorageGcs;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\S3;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\S3Compatible;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\WebFolder;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\WebProxy;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Schema for origin resources.
 *
 * @phpstan-type origin_alias = S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim
 */
final class Origin implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [
            S3::class,
            S3Compatible::class,
            CloudinaryBackup::class,
            WebFolder::class,
            WebProxy::class,
            GoogleCloudStorageGcs::class,
            AzureBlobStorage::class,
            AkeneoPim::class,
        ];
    }
}
