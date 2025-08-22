<?php

declare(strict_types=1);

namespace ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem\Schema\DefaultValue;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Primitive JSON scalar.
 *
 * @phpstan-type json_scalar_array_alias = string|float|bool
 */
final class JsonScalarArray implements ConverterSource
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
