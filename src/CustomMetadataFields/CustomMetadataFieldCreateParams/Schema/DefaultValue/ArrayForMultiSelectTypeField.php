<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema\DefaultValue;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type array_for_multi_select_type_field_alias = string|float|bool
 */
final class ArrayForMultiSelectTypeField implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return ['string', 'float', 'bool'];
    }
}
