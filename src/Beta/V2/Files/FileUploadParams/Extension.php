<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams;

use ImageKit\Core\Concerns\Union;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Shared\AutoDescriptionExtension;
use ImageKit\Shared\AutoTaggingExtension;
use ImageKit\Shared\RemovedotBgExtension;

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
