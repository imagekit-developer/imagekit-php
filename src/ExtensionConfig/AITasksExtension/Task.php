<?php

declare(strict_types=1);

namespace Imagekit\ExtensionConfig\AITasksExtension;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskSelectMetadata;
use Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskSelectTags;
use Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo;

/**
 * @phpstan-import-type AITaskSelectTagsShape from \Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskSelectTags
 * @phpstan-import-type AITaskSelectMetadataShape from \Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskSelectMetadata
 * @phpstan-import-type AITaskYesNoShape from \Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo
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
