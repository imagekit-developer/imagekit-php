<?php

declare(strict_types=1);

namespace ImageKit\Files\Details\DetailUpdateParams;

use ImageKit\Core\Concerns\Union;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Files\Details\DetailUpdateParams\Extension\AutoTaggingExtension;
use ImageKit\Files\Details\DetailUpdateParams\Extension\RemovedotBgExtension;

/**
 * @phpstan-type extension_alias = RemovedotBgExtension|AutoTaggingExtension
 */
final class Extension implements ConverterSource
{
    use Union;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return [RemovedotBgExtension::class, AutoTaggingExtension::class];
    }
}
