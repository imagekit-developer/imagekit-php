<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\ExtensionItem\AITasksExtension;
use Imagekit\ExtensionItem\AutoDescriptionExtension;
use Imagekit\ExtensionItem\AutoTaggingExtension;
use Imagekit\ExtensionItem\RemovedotBgExtension;
use Imagekit\ExtensionItem\SavedExtensionReference;

/**
 * @phpstan-import-type RemovedotBgExtensionShape from \Imagekit\ExtensionItem\RemovedotBgExtension
 * @phpstan-import-type AutoTaggingExtensionShape from \Imagekit\ExtensionItem\AutoTaggingExtension
 * @phpstan-import-type AutoDescriptionExtensionShape from \Imagekit\ExtensionItem\AutoDescriptionExtension
 * @phpstan-import-type AITasksExtensionShape from \Imagekit\ExtensionItem\AITasksExtension
 * @phpstan-import-type SavedExtensionReferenceShape from \Imagekit\ExtensionItem\SavedExtensionReference
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
