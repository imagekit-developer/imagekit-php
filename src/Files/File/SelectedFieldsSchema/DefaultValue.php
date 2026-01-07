<?php

declare(strict_types=1);

namespace Imagekit\Files\File\SelectedFieldsSchema;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\Core\Conversion\ListOf;
use Imagekit\Files\File\SelectedFieldsSchema\DefaultValue\Mixed_;

/**
 * The default value for this custom metadata field. The value should match the `type` of custom metadata field.
 *
 * @phpstan-import-type MixedShape from \Imagekit\Files\File\SelectedFieldsSchema\DefaultValue\Mixed_
 *
 * @phpstan-type DefaultValueVariants = string|float|bool|list<string|float|bool>
 * @phpstan-type DefaultValueShape = DefaultValueVariants|list<MixedShape>
 */
final class DefaultValue implements ConverterSource
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
