<?php

declare(strict_types=1);

namespace ImageKit\Services\Files;

use ImageKit\Client;
use ImageKit\ServiceContracts\Files\MetadataContract;

final class MetadataService implements MetadataContract
{
    /**
     * @api
     */
    public MetadataRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MetadataRawService($client);
    }
}
