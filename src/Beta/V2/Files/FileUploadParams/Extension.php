<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams;

use ImageKit\Beta\V2\Files\FileUploadParams\Extension\AutoDescriptionExtension;
use ImageKit\Beta\V2\Files\FileUploadParams\Extension\AutoTaggingExtension;
use ImageKit\Beta\V2\Files\FileUploadParams\Extension\RemovedotBgExtension;
use ImageKit\Core\Concerns\Union;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type extension_alias = RemovedotBgExtension|AutoTaggingExtension|AutoDescriptionExtension
 */
final class Extension implements ConverterSource
{
    use Union;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
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
