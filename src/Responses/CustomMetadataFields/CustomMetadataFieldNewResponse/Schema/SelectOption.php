<?php

declare(strict_types=1);

namespace ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldNewResponse\Schema;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type select_option_alias = string|float|bool
 */
final class SelectOption implements ConverterSource
{
    use SdkUnion;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return ['string', 'float', 'bool'];
    }
}
