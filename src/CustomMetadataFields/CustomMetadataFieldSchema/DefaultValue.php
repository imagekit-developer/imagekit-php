<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields\CustomMetadataFieldSchema;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\DefaultValue\Mixed_;

/**
 * The default value for this custom metadata field. Data type of default value depends on the field type.
 *
 * @phpstan-import-type MixedShape from \ImageKit\CustomMetadataFields\CustomMetadataFieldSchema\DefaultValue\Mixed_
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
