<?php

declare(strict_types=1);

namespace ImageKit\Core\Services;

use ImageKit\Client;
use ImageKit\Core\ServiceContracts\AccountsContract;
use ImageKit\Core\Services\Accounts\OriginsService;
use ImageKit\Core\Services\Accounts\URLEndpointsService;
use ImageKit\Core\Services\Accounts\UsageService;

final class AccountsService implements AccountsContract
{
    /**
     * @@api
     */
    public UsageService $usage;

    /**
     * @@api
     */
    public OriginsService $origins;

    /**
     * @@api
     */
    public URLEndpointsService $urlEndpoints;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->usage = new UsageService($this->client);
        $this->origins = new OriginsService($this->client);
        $this->urlEndpoints = new URLEndpointsService($this->client);
    }
}
