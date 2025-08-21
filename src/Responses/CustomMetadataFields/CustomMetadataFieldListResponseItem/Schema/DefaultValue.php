<?php

declare(strict_types=1);

namespace ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem\Schema;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem\Schema\DefaultValue\UnionMember3;

/**
 * The default value for this custom metadata field. Date type of default value depends on the field type.
 *
 * @phpstan-type default_value_alias = string|float|bool|list<string|float|bool>
 */
final class DefaultValue implements ConverterSource
{
    use SdkUnion;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return ['string', 'float', 'bool', new ListOf(UnionMember3::class)];
    }
}
