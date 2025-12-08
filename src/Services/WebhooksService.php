<?php

declare(strict_types=1);

namespace Imagekit\Services;

use Imagekit\Client;
use Imagekit\ServiceContracts\WebhooksContract;

final class WebhooksService implements WebhooksContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
