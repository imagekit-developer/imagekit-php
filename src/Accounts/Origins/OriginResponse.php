<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins;

use ImageKit\Accounts\Origins\OriginResponse\AkeneoPim;
use ImageKit\Accounts\Origins\OriginResponse\AzureBlob;
use ImageKit\Accounts\Origins\OriginResponse\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginResponse\Gcs;
use ImageKit\Accounts\Origins\OriginResponse\S3;
use ImageKit\Accounts\Origins\OriginResponse\S3Compatible;
use ImageKit\Accounts\Origins\OriginResponse\WebFolder;
use ImageKit\Accounts\Origins\OriginResponse\WebProxy;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

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
            'GCS' => Gcs::class,
            'AZURE_BLOB' => AzureBlob::class,
            'AKENEO_PIM' => AkeneoPim::class,
        ];
    }
}
