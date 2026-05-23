<?php

declare(strict_types=1);

namespace ImageKit\Services\Beta;

use ImageKit\Client;
use ImageKit\ServiceContracts\Beta\V2RawContract;

final class V2RawService implements V2RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
