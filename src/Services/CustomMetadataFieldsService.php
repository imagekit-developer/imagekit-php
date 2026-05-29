<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\ServiceContracts\CustomMetadataFieldsContract;

final class CustomMetadataFieldsService implements CustomMetadataFieldsContract
{
    /**
     * @api
     */
    public CustomMetadataFieldsRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CustomMetadataFieldsRawService($client);
    }
}
