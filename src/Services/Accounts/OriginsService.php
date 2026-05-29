<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Client;
use ImageKit\ServiceContracts\Accounts\OriginsContract;

final class OriginsService implements OriginsContract
{
    /**
     * @api
     */
    public OriginsRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new OriginsRawService($client);
    }
}
