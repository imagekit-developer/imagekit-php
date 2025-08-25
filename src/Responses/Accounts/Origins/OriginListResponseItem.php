<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\Origins;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AkeneoPim;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AzureBlob;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\CloudinaryBackup;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\Gcs;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3Compatible;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebFolder;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebProxy;

/**
 * Origin object as returned by the API (sensitive fields removed).
 */
final class OriginListResponseItem implements ConverterSource
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
