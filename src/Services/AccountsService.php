<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\ServiceContracts\AccountsContract;
use ImageKit\Services\Accounts\OriginsService;
use ImageKit\Services\Accounts\URLEndpointsService;
use ImageKit\Services\Accounts\UsageAnalyticsService;
use ImageKit\Services\Accounts\UsageService;

final class AccountsService implements AccountsContract
{
    /**
     * @api
     */
    public AccountsRawService $raw;

    /**
     * @api
     */
    public UsageService $usage;

    /**
     * @api
     */
    public UsageAnalyticsService $usageAnalytics;

    /**
     * @api
     */
    public OriginsService $origins;

    /**
     * @api
     */
    public URLEndpointsService $urlEndpoints;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AccountsRawService($client);
        $this->usage = new UsageService($client);
        $this->usageAnalytics = new UsageAnalyticsService($client);
        $this->origins = new OriginsService($client);
        $this->urlEndpoints = new URLEndpointsService($client);
    }
}
