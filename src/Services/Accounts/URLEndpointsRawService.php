<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Client;
use ImageKit\ServiceContracts\Accounts\URLEndpointsRawContract;

final class URLEndpointsRawService implements URLEndpointsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
