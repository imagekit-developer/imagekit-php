<?php

declare(strict_types=1);

namespace ImageKit\Shared\RemovedotBgExtension;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the background removal extension.
 *
 * @phpstan-type name_alias = Name::*
 */
final class Name implements ConverterSource
{
    use Enum;

    public const REMOVE_BG = 'remove-bg';
}
