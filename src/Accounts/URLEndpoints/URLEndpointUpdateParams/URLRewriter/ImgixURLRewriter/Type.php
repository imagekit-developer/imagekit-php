<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\ImgixURLRewriter;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const IMGIX = 'IMGIX';
}
