<?php

declare(strict_types=1);

namespace ImageKit\Core\Conversion;

use ImageKit\Core\Conversion\Concerns\ArrayOf;
use ImageKit\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
