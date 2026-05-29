<?php

declare(strict_types=1);

namespace ImageKit\Services\Beta\V2;

use ImageKit\Client;
use ImageKit\ServiceContracts\Beta\V2\FilesRawContract;

final class FilesRawService implements FilesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
