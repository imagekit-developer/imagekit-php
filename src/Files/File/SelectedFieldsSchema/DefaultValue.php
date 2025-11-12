<?php

declare(strict_types=1);

namespace ImageKit\Files\File\SelectedFieldsSchema;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Files\File\SelectedFieldsSchema\DefaultValue\Mixed1;

/**
 * The default value for this custom metadata field. The value should match the `type` of custom metadata field.
 */
final class DefaultValue implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'float', 'bool', new ListOf(Mixed1::class)];
    }
}
