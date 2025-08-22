<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema\DefaultValue;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Primitive JSON scalar.
 *
 * @phpstan-type union_member0_alias = string|float|bool
 */
final class UnionMember0 implements ConverterSource
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
