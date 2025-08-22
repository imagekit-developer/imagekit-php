<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginCreateParams;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const AKENEO_PIM = 'AKENEO_PIM';

    public const S3 = 'S3';

    public const S3_COMPATIBLE = 'S3_COMPATIBLE';

    public const CLOUDINARY_BACKUP = 'CLOUDINARY_BACKUP';

    public const WEB_FOLDER = 'WEB_FOLDER';

    public const WEB_PROXY = 'WEB_PROXY';

    public const GCS = 'GCS';

    public const AZURE_BLOB = 'AZURE_BLOB';
}
