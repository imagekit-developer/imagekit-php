<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Client;
use ImageKit\ServiceContracts\Accounts\UsageRawContract;

final class UsageRawService implements UsageRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
