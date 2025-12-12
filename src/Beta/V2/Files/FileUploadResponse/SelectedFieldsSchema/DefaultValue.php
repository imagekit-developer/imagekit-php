<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files\FileUploadResponse\SelectedFieldsSchema;

use Imagekit\Beta\V2\Files\FileUploadResponse\SelectedFieldsSchema\DefaultValue\Mixed_;
use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\Core\Conversion\ListOf;

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
        return ['string', 'float', 'bool', new ListOf(Mixed_::class)];
    }
}
