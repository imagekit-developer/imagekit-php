<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Configuration object for an extension (base extensions only, not saved extension references).
 *
 * @phpstan-import-type RemovedotBgExtensionShape from \ImageKit\RemovedotBgExtension
 * @phpstan-import-type AutoTaggingExtensionShape from \ImageKit\AutoTaggingExtension
 * @phpstan-import-type AutoDescriptionExtensionShape from \ImageKit\AutoDescriptionExtension
 * @phpstan-import-type AITasksExtensionShape from \ImageKit\AITasksExtension
 *
 * @phpstan-type ExtensionConfigVariants = RemovedotBgExtension|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension
 * @phpstan-type ExtensionConfigShape = ExtensionConfigVariants|RemovedotBgExtensionShape|AutoTaggingExtensionShape|AutoDescriptionExtensionShape|AITasksExtensionShape
 */
final class ExtensionConfig implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'name';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            AutoTaggingExtension::class,
            'remove-bg' => RemovedotBgExtension::class,
            'ai-auto-description' => AutoDescriptionExtension::class,
            'ai-tasks' => AITasksExtension::class,
        ];
    }
}
