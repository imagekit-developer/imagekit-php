<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Files\UpdateFileRequest\ChangePublicationStatus;
use ImageKit\Files\UpdateFileRequest\UpdateFileDetails;

/**
 * Schema for update file update request.
 */
final class UpdateFileRequest implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [UpdateFileDetails::class, ChangePublicationStatus::class];
    }
}
