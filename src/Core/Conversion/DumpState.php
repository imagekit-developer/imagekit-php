<?php

declare(strict_types=1);

namespace Imagekit\Core\Conversion;

/**
 * @internal
 */
final class DumpState
{
    public function __construct(
        public bool $canRetry = true
    ) {}
}
