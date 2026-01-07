<?php

declare(strict_types=1);

namespace Imagekit\CustomMetadataFields\CustomMetadataField\Schema;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Maximum value of the field. Only set if field type is `Date` or `Number`. For `Date` type field, the value will be in ISO8601 string format. For `Number` type field, it will be a numeric value.
 *
 * @phpstan-type MaxValueVariants = string|float
 * @phpstan-type MaxValueShape = MaxValueVariants
 */
final class MaxValue implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'float'];
    }
}
