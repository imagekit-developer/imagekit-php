<?php

declare(strict_types=1);

namespace ImageKit\Core\Conversion\Contracts;

use ImageKit\Core\Conversion\CoerceState;
use ImageKit\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
