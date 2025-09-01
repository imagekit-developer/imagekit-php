<?php

declare(strict_types=1);

namespace ImageKit\Core\Services;

use ImageKit\Client;
use ImageKit\Core\ServiceContracts\WebhooksContract;

final class WebhooksService implements WebhooksContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
