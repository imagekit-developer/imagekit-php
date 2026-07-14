<?php

declare(strict_types=1);

namespace ImageKit\Core\Conversion;

use ImageKit\Core\Conversion\Concerns\ArrayOf;
use ImageKit\Core\Conversion\Contracts\Converter;

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
