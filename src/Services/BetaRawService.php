<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\ServiceContracts\BetaRawContract;

final class BetaRawService implements BetaRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
