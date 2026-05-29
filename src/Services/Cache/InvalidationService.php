<?php

declare(strict_types=1);

namespace ImageKit\Services\Cache;

use ImageKit\Client;
use ImageKit\ServiceContracts\Cache\InvalidationContract;

final class InvalidationService implements InvalidationContract
{
    /**
     * @api
     */
    public InvalidationRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InvalidationRawService($client);
    }
}
