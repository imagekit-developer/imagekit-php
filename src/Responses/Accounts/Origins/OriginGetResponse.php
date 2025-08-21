<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\Origins;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AkeneoPim;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AzureBlobStorage;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\CloudinaryBackup;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\GoogleCloudStorageGcs;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3Compatible;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebFolder;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebProxy;

/**
 * Origin object as returned by the API (sensitive fields removed).
 *
 * @phpstan-type origin_get_response_alias = S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim
 */
final class OriginGetResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
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
