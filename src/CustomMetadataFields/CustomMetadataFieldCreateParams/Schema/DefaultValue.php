<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema\DefaultValue\UnionMember3;

/**
 * The default value for this custom metadata field. This property is only required if `isValueRequired` property is set to `true`. The value should match the `type` of custom metadata field.
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
