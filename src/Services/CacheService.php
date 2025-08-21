<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\Contracts\CacheContract;
use ImageKit\Services\Cache\InvalidationService;

final class CacheService implements CacheContract
{
    public InvalidationService $invalidation;

    public function __construct(private Client $client)
    {
        $this->invalidation = new InvalidationService($this->client);
    }
}
