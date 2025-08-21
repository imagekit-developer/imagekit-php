<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\Contracts\BetaContract;
use ImageKit\Services\Beta\V2Service;

final class BetaService implements BetaContract
{
    public V2Service $v2;

    public function __construct(private Client $client)
    {
        $this->v2 = new V2Service($this->client);
    }
}
