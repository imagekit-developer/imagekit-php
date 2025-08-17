<?php

declare(strict_types=1);

namespace ImageKit\Accounts;

use ImageKit\Accounts\Origins\OriginsService;
use ImageKit\Accounts\URLEndpoints\URLEndpointsService;
use ImageKit\Accounts\Usage\UsageService;
use ImageKit\Client;
use ImageKit\Contracts\AccountsContract;

final class AccountsService implements AccountsContract
{
    public UsageService $usage;

    public OriginsService $origins;

    public URLEndpointsService $urlEndpoints;

    public function __construct(private Client $client)
    {
        $this->usage = new UsageService($this->client);
        $this->origins = new OriginsService($this->client);
        $this->urlEndpoints = new URLEndpointsService($this->client);
    }
}
