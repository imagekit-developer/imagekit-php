<?php

declare(strict_types=1);

namespace Imagekit\Services;

use Imagekit\Client;
use Imagekit\ServiceContracts\AccountsContract;
use Imagekit\Services\Accounts\OriginsService;
use Imagekit\Services\Accounts\URLEndpointsService;
use Imagekit\Services\Accounts\UsageService;

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
        $this->origins = new OriginsService($client);
        $this->urlEndpoints = new URLEndpointsService($client);
    }
}
