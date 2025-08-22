<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Files\FileUploadParams\Extension\AutoDescriptionExtension;
use ImageKit\Files\FileUploadParams\Extension\AutoTaggingExtension;
use ImageKit\Files\FileUploadParams\Extension\RemovedotBgExtension;

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
