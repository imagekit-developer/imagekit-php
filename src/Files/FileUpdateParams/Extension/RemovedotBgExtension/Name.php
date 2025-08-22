<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUpdateParams\Extension\RemovedotBgExtension;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the background removal extension.
 *
 * @phpstan-type name_alias = Name::*
 */
final class Name implements ConverterSource
{
    use SdkEnum;

    public const REMOVE_BG = 'remove-bg';
}
