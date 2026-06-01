<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\ExtensionItem\AITasksExtension;
use ImageKit\ExtensionItem\AutoDescriptionExtension;
use ImageKit\ExtensionItem\AutoTaggingExtension;
use ImageKit\ExtensionItem\RemovedotBgExtension;
use ImageKit\SavedExtensions\SavedExtensionReference;

/**
 * @phpstan-import-type RemovedotBgExtensionShape from \ImageKit\ExtensionItem\RemovedotBgExtension
 * @phpstan-import-type AutoTaggingExtensionShape from \ImageKit\ExtensionItem\AutoTaggingExtension
 * @phpstan-import-type AutoDescriptionExtensionShape from \ImageKit\ExtensionItem\AutoDescriptionExtension
 * @phpstan-import-type AITasksExtensionShape from \ImageKit\ExtensionItem\AITasksExtension
 * @phpstan-import-type SavedExtensionReferenceShape from \ImageKit\SavedExtensions\SavedExtensionReference
 *
 * @phpstan-type ExtensionItemVariants = RemovedotBgExtension|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension|SavedExtensionReference
 * @phpstan-type ExtensionItemShape = ExtensionItemVariants|RemovedotBgExtensionShape|AutoTaggingExtensionShape|AutoDescriptionExtensionShape|AITasksExtensionShape|SavedExtensionReferenceShape
 */
final class ExtensionItem implements ConverterSource
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
            'saved-extension' => SavedExtensionReference::class,
        ];
    }
}
