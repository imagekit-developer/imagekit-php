<?php

declare(strict_types=1);

namespace ImageKit\Services\Beta\V2;

use ImageKit\Client;
use ImageKit\ServiceContracts\Beta\V2\FilesContract;

final class FilesService implements FilesContract
{
    /**
     * @api
     */
    public FilesRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FilesRawService($client);
    }
}
