<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUpdateParams;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Files\FileUpdateParams\Update\ChangePublicationStatus;
use ImageKit\Files\FileUpdateParams\Update\UpdateFileDetails;

/**
 * @phpstan-type update_alias = UpdateFileDetails|ChangePublicationStatus
 */
final class Update implements ConverterSource
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
