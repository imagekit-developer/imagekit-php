<?php

declare(strict_types=1);

namespace ImageKit\Cache;

use ImageKit\Cache\Invalidation\InvalidationService;
use ImageKit\Client;
use ImageKit\Contracts\CacheContract;

final class CacheService implements CacheContract
{
    public InvalidationService $invalidation;

    public function __construct(private Client $client)
    {
        $this->invalidation = new InvalidationService($this->client);
    }
}
