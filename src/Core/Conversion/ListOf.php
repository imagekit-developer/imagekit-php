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

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
