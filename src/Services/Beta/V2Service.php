<?php

declare(strict_types=1);

namespace Imagekit\Services\Beta;

use Imagekit\Client;
use Imagekit\ServiceContracts\Beta\V2Contract;
use Imagekit\Services\Beta\V2\FilesService;

final class V2Service implements V2Contract
{
    /**
     * @api
     */
    public V2RawService $raw;

    /**
     * @api
     */
    public FilesService $files;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V2RawService($client);
        $this->files = new FilesService($client);
    }
}
