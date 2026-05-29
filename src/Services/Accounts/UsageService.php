<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Client;
use ImageKit\ServiceContracts\Accounts\UsageContract;

final class UsageService implements UsageContract
{
    /**
     * @api
     */
    public UsageRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UsageRawService($client);
    }
}
