<?php

declare(strict_types=1);

namespace Imagekit\Services;

use Imagekit\Client;
use Imagekit\ServiceContracts\CacheContract;
use Imagekit\Services\Cache\InvalidationService;

final class CacheService implements CacheContract
{
    /**
     * @api
     */
    public CacheRawService $raw;

    /**
     * @api
     */
    public InvalidationService $invalidation;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CacheRawService($client);
        $this->invalidation = new InvalidationService($client);
    }
}
