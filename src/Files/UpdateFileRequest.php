<?php

declare(strict_types=1);

namespace Imagekit\Files;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\Files\UpdateFileRequest\ChangePublicationStatus;
use Imagekit\Files\UpdateFileRequest\UpdateFileDetails;

/**
 * Schema for update file update request.
 *
 * @phpstan-import-type UpdateFileDetailsShape from \Imagekit\Files\UpdateFileRequest\UpdateFileDetails
 * @phpstan-import-type ChangePublicationStatusShape from \Imagekit\Files\UpdateFileRequest\ChangePublicationStatus
 *
 * @phpstan-type UpdateFileRequestVariants = UpdateFileDetails|ChangePublicationStatus
 * @phpstan-type UpdateFileRequestShape = UpdateFileRequestVariants|UpdateFileDetailsShape|ChangePublicationStatusShape
 */
final class UpdateFileRequest implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [UpdateFileDetails::class, ChangePublicationStatus::class];
    }
}
