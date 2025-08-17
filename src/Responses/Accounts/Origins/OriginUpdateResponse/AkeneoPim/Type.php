<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AkeneoPim;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const AKENEO_PIM = 'AKENEO_PIM';
}
