<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\Contracts\AccountsContract;
use ImageKit\Services\Accounts\OriginsService;
use ImageKit\Services\Accounts\URLEndpointsService;
use ImageKit\Services\Accounts\UsageService;

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
