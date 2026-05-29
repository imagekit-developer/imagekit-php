<?php

declare(strict_types=1);

namespace ImageKit\Services\Files;

use ImageKit\Client;
use ImageKit\ServiceContracts\Files\BulkContract;

final class BulkService implements BulkContract
{
    /**
     * @api
     */
    public BulkRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BulkRawService($client);
    }
}
