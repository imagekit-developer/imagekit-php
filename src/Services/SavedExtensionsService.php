<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\ServiceContracts\SavedExtensionsContract;

final class SavedExtensionsService implements SavedExtensionsContract
{
    /**
     * @api
     */
    public SavedExtensionsRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SavedExtensionsRawService($client);
    }
}
