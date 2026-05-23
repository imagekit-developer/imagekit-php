<?php

declare(strict_types=1);

namespace ImageKit\ExtensionItem\AITasksExtension;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\ExtensionItem\AITasksExtension\Task\AITaskSelectMetadata;
use ImageKit\ExtensionItem\AITasksExtension\Task\AITaskSelectTags;
use ImageKit\ExtensionItem\AITasksExtension\Task\AITaskYesNo;

/**
 * @phpstan-import-type AITaskSelectTagsShape from \ImageKit\ExtensionItem\AITasksExtension\Task\AITaskSelectTags
 * @phpstan-import-type AITaskSelectMetadataShape from \ImageKit\ExtensionItem\AITasksExtension\Task\AITaskSelectMetadata
 * @phpstan-import-type AITaskYesNoShape from \ImageKit\ExtensionItem\AITasksExtension\Task\AITaskYesNo
 *
 * @phpstan-type TaskVariants = AITaskSelectTags|AITaskSelectMetadata|AITaskYesNo
 * @phpstan-type TaskShape = TaskVariants|AITaskSelectTagsShape|AITaskSelectMetadataShape|AITaskYesNoShape
 */
final class Task implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'select_tags' => AITaskSelectTags::class,
            'select_metadata' => AITaskSelectMetadata::class,
            'yes_no' => AITaskYesNo::class,
        ];
    }
}
