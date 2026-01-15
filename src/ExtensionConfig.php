<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\ExtensionConfig\AITasksExtension;
use Imagekit\ExtensionConfig\AutoDescriptionExtension;
use Imagekit\ExtensionConfig\AutoTaggingExtension;
use Imagekit\ExtensionConfig\RemovedotBgExtension;

/**
 * Configuration object for an extension (base extensions only, not saved extension references).
 *
 * @phpstan-import-type RemovedotBgExtensionShape from \Imagekit\ExtensionConfig\RemovedotBgExtension
 * @phpstan-import-type AutoTaggingExtensionShape from \Imagekit\ExtensionConfig\AutoTaggingExtension
 * @phpstan-import-type AutoDescriptionExtensionShape from \Imagekit\ExtensionConfig\AutoDescriptionExtension
 * @phpstan-import-type AITasksExtensionShape from \Imagekit\ExtensionConfig\AITasksExtension
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
