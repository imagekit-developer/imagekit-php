<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\Origins;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AkeneoPim;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AzureBlobStorage;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\CloudinaryBackup;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\GoogleCloudStorageGcs;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3Compatible;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebFolder;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebProxy;

/**
 * Origin object as returned by the API (sensitive fields removed).
 *
 * @phpstan-type origin_list_response_item_alias = S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim
 */
final class OriginListResponseItem implements ConverterSource
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
