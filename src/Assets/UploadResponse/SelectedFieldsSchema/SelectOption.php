<?php

declare(strict_types=1);

namespace ImageKit\Assets\UploadResponse\SelectedFieldsSchema;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type SelectOptionVariants = string|float|bool
 * @phpstan-type SelectOptionShape = SelectOptionVariants
 */
final class SelectOption implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'float', 'bool'];
    }
}
