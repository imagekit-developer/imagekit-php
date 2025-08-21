<?php

declare(strict_types=1);

namespace ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem\Schema;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Minimum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
 *
 * @phpstan-type min_value_alias = string|float
 */
final class MinValue implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return ['string', 'float'];
    }
}
