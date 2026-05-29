<?php

declare(strict_types=1);

namespace ImageKit\Services\Cache;

use ImageKit\Client;
use ImageKit\ServiceContracts\Cache\InvalidationRawContract;

final class InvalidationRawService implements InvalidationRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
