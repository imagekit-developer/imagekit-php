<?php

declare(strict_types=1);

namespace ImageKit\Services\Beta;

use ImageKit\Client;
use ImageKit\Contracts\Beta\V2Contract;
use ImageKit\Services\Beta\V2\FilesService;

final class V2Service implements V2Contract
{
    public FilesService $files;

    public function __construct(private Client $client)
    {
        $this->files = new FilesService($this->client);
    }
}
