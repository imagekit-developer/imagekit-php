<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\ExtensionConfig\AITasksExtension;
use ImageKit\ExtensionConfig\AutoDescriptionExtension;
use ImageKit\ExtensionConfig\AutoTaggingExtension;
use ImageKit\ExtensionConfig\RemovedotBgExtension;

/**
 * Configuration object for an extension (base extensions only, not saved extension references).
 *
 * @phpstan-import-type RemovedotBgExtensionShape from \ImageKit\ExtensionConfig\RemovedotBgExtension
 * @phpstan-import-type AutoTaggingExtensionShape from \ImageKit\ExtensionConfig\AutoTaggingExtension
 * @phpstan-import-type AutoDescriptionExtensionShape from \ImageKit\ExtensionConfig\AutoDescriptionExtension
 * @phpstan-import-type AITasksExtensionShape from \ImageKit\ExtensionConfig\AITasksExtension
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
