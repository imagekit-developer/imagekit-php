<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebProxy;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const WEB_PROXY = 'WEB_PROXY';
}
