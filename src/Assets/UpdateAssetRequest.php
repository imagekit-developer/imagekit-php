<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Assets\UpdateAssetRequest\ChangePublicationStatus;
use ImageKit\Assets\UpdateAssetRequest\UpdateFileDetails;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Schema for the update asset request body.
 *
 * @phpstan-import-type UpdateFileDetailsShape from \ImageKit\Assets\UpdateAssetRequest\UpdateFileDetails
 * @phpstan-import-type ChangePublicationStatusShape from \ImageKit\Assets\UpdateAssetRequest\ChangePublicationStatus
 *
 * @phpstan-type UpdateAssetRequestVariants = UpdateFileDetails|ChangePublicationStatus
 * @phpstan-type UpdateAssetRequestShape = UpdateAssetRequestVariants|UpdateFileDetailsShape|ChangePublicationStatusShape
 */
final class UpdateAssetRequest implements ConverterSource
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
