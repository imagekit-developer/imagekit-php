<?php

declare(strict_types=1);

namespace Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Minimum value of the field. Only set this property if field type is `Date` or `Number`. For `Date` type field, set the minimum date in ISO8601 string format. For `Number` type field, set the minimum numeric value.
 *
 * @phpstan-type MinValueVariants = string|float
 * @phpstan-type MinValueShape = MinValueVariants
 */
final class MinValue implements ConverterSource
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
