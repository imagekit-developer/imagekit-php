<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3Compatible;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const S3_COMPATIBLE = 'S3_COMPATIBLE';
}
