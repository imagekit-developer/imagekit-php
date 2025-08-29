<?php

declare(strict_types=1);

namespace ImageKit\Core\Services;

use ImageKit\Client;
use ImageKit\Core\ServiceContracts\BetaContract;
use ImageKit\Core\Services\Beta\V2Service;

final class BetaService implements BetaContract
{
    /**
     * @@api
     */
    public V2Service $v2;

    public function __construct(private Client $client)
    {
        $this->v2 = new V2Service($this->client);
    }
}
