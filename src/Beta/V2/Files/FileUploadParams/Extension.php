<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams;

use ImageKit\Beta\V2\Files\FileUploadParams\Extension\AutoDescriptionExtension;
use ImageKit\Beta\V2\Files\FileUploadParams\Extension\AutoTaggingExtension;
use ImageKit\Beta\V2\Files\FileUploadParams\Extension\RemovedotBgExtension;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type extension_alias = RemovedotBgExtension|AutoTaggingExtension|AutoDescriptionExtension
 */
final class Extension implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [
            RemovedotBgExtension::class,
            AutoTaggingExtension::class,
            AutoDescriptionExtension::class,
        ];
    }
}
