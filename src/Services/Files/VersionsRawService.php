<?php

declare(strict_types=1);

namespace ImageKit\Services\Files;

use ImageKit\Client;
use ImageKit\ServiceContracts\Files\VersionsRawContract;

final class VersionsRawService implements VersionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
