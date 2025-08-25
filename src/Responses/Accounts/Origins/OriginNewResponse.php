<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\Origins;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AkeneoPim;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AzureBlobStorage;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\CloudinaryBackup;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\GoogleCloudStorageGcs;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3Compatible;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebFolder;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebProxy;

final class OriginNewResponse implements ConverterSource
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
