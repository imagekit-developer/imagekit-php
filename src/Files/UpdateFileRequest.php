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
