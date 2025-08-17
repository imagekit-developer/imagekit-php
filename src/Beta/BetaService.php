<?php

declare(strict_types=1);

namespace ImageKit\Beta;

use ImageKit\Beta\V2\V2Service;
use ImageKit\Client;
use ImageKit\Contracts\BetaContract;

final class BetaService implements BetaContract
{
    public V2Service $v2;

    public function __construct(private Client $client)
    {
        $this->v2 = new V2Service($this->client);
    }
}
