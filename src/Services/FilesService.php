<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\ServiceContracts\FilesContract;
use ImageKit\Services\Files\BulkService;
use ImageKit\Services\Files\MetadataService;
use ImageKit\Services\Files\VersionsService;

final class FilesService implements FilesContract
{
    /**
     * @api
     */
    public FilesRawService $raw;

    /**
     * @api
     */
    public BulkService $bulk;

    /**
     * @api
     */
    public VersionsService $versions;

    /**
     * @api
     */
    public MetadataService $metadata;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FilesRawService($client);
        $this->bulk = new BulkService($client);
        $this->versions = new VersionsService($client);
        $this->metadata = new MetadataService($client);
    }
}
