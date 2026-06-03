<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\ExtensionItem\AutoDescriptionExtension;
use ImageKit\SavedExtensions\SavedExtensionReference;

/**
 * @phpstan-import-type RemovedotBgextensionShape from \ImageKit\RemovedotBgextension
 * @phpstan-import-type AutoTaggingExtensionShape from \ImageKit\AutoTaggingExtension
 * @phpstan-import-type AutoDescriptionExtensionShape from \ImageKit\ExtensionItem\AutoDescriptionExtension
 * @phpstan-import-type AITasksExtensionShape from \ImageKit\AITasksExtension
 * @phpstan-import-type SavedExtensionReferenceShape from \ImageKit\SavedExtensions\SavedExtensionReference
 *
 * @phpstan-type ExtensionItemVariants = RemovedotBgextension|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension|SavedExtensionReference
 * @phpstan-type ExtensionItemShape = ExtensionItemVariants|RemovedotBgextensionShape|AutoTaggingExtensionShape|AutoDescriptionExtensionShape|AITasksExtensionShape|SavedExtensionReferenceShape
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
            'remove-bg' => RemovedotBgextension::class,
            'ai-auto-description' => AutoDescriptionExtension::class,
            'ai-tasks' => AITasksExtension::class,
            'saved-extension' => SavedExtensionReference::class,
        ];
    }
}
