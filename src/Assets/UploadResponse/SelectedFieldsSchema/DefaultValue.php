<?php

declare(strict_types=1);

namespace ImageKit\Assets\UploadResponse\SelectedFieldsSchema;

use ImageKit\Assets\UploadResponse\SelectedFieldsSchema\DefaultValue\Mixed_;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Core\Conversion\ListOf;

/**
 * The default value for this custom metadata field. Data type of default value depends on the field type.
 *
 * @phpstan-import-type MixedShape from \ImageKit\Assets\UploadResponse\SelectedFieldsSchema\DefaultValue\Mixed_
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
