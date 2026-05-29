<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Client;
use ImageKit\ServiceContracts\Accounts\URLEndpointsContract;

final class URLEndpointsService implements URLEndpointsContract
{
    /**
     * @api
     */
    public URLEndpointsRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new URLEndpointsRawService($client);
    }
}
