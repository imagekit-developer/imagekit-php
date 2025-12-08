<?php

declare(strict_types=1);

namespace Imagekit\Core\Conversion;

use Imagekit\Core\Conversion\Concerns\ArrayOf;
use Imagekit\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    private function empty(): array|object // @phpstan-ignore-line
    {
        return [];
    }
}
