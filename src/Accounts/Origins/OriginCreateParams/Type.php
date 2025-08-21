<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins\OriginCreateParams;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const AKENEO_PIM = 'AKENEO_PIM';
}
