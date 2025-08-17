<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2;

use ImageKit\Beta\V2\Files\FilesService;
use ImageKit\Client;
use ImageKit\Contracts\Beta\V2Contract;

final class V2Service implements V2Contract
{
    public FilesService $files;

    public function __construct(private Client $client)
    {
        $this->files = new FilesService($this->client);
    }
}
