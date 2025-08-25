<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\Origins;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AkeneoPim;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AzureBlobStorage;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\CloudinaryBackup;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\GoogleCloudStorageGcs;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3Compatible;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebFolder;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebProxy;

final class OriginUpdateResponse implements ConverterSource
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
