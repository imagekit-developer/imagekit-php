<?php

declare(strict_types=1);

namespace ImageKit\Shared\AutoDescriptionExtension;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the auto description extension.
 *
 * @phpstan-type name_alias = Name::*
 */
final class Name implements ConverterSource
{
    use SdkEnum;

    public const AI_AUTO_DESCRIPTION = 'ai-auto-description';
}
