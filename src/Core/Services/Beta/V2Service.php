<?php

declare(strict_types=1);

namespace ImageKit\Core\Services\Beta;

use ImageKit\Client;
use ImageKit\Core\ServiceContracts\Beta\V2Contract;
use ImageKit\Core\Services\Beta\V2\FilesService;

final class V2Service implements V2Contract
{
    /**
     * @@api
     */
    public FilesService $files;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->files = new FilesService($this->client);
    }
}
