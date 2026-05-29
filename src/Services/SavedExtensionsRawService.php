<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\ServiceContracts\SavedExtensionsRawContract;

final class SavedExtensionsRawService implements SavedExtensionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
