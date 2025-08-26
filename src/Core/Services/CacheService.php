<?php

declare(strict_types=1);

namespace ImageKit\Core\Services;

use ImageKit\Client;
use ImageKit\Core\ServiceContracts\CacheContract;
use ImageKit\Core\Services\Cache\InvalidationService;

final class CacheService implements CacheContract
{
    public InvalidationService $invalidation;

    public function __construct(private Client $client)
    {
        $this->invalidation = new InvalidationService($this->client);
    }
}
