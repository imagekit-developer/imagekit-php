<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Client;
use ImageKit\ServiceContracts\Accounts\OriginsRawContract;

final class OriginsRawService implements OriginsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
