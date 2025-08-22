<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\Contracts\WebhooksContract;

final class WebhooksService implements WebhooksContract
{
    public function __construct(private Client $client) {}
}
