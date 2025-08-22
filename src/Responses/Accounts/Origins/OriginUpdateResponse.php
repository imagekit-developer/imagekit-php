<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\Origins;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AkeneoPim;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AzureBlob;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\CloudinaryBackup;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\Gcs;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3Compatible;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebFolder;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebProxy;

/**
 * Origin object as returned by the API (sensitive fields removed).
 *
 * @phpstan-type origin_update_response_alias = S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim
 */
final class OriginUpdateResponse implements ConverterSource
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
