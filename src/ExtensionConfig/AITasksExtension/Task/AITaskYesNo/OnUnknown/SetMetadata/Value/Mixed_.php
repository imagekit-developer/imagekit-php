<?php

declare(strict_types=1);

namespace Imagekit\ExtensionConfig\AITasksExtension\Task\AITaskYesNo\OnUnknown\SetMetadata\Value;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type MixedVariants = string|float|bool
 * @phpstan-type MixedShape = MixedVariants
 */
final class Mixed_ implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'float', 'bool'];
    }
}
