<?php

declare(strict_types=1);

namespace Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnUnknown\SetMetadata;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\Core\Conversion\ListOf;
use Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnUnknown\SetMetadata\Value\Mixed_;

/**
 * Value to set for the custom metadata field. The value type should match the custom metadata field type.
 *
 * @phpstan-import-type MixedShape from \Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnUnknown\SetMetadata\Value\Mixed_
 *
 * @phpstan-type ValueVariants = string|float|bool|list<string|float|bool>
 * @phpstan-type ValueShape = ValueVariants|list<MixedShape>
 */
final class Value implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'float', 'bool', new ListOf(Mixed_::class)];
    }
}
