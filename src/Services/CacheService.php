<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\ServiceContracts\CacheContract;
use ImageKit\Services\Cache\InvalidationService;

final class CacheService implements CacheContract
{
    /**
     * @@api
     */
    public InvalidationService $invalidation;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->invalidation = new InvalidationService($this->client);
    }
}
