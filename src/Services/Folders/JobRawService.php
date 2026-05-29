<?php

declare(strict_types=1);

namespace ImageKit\Services\Folders;

use ImageKit\Client;
use ImageKit\ServiceContracts\Folders\JobRawContract;

final class JobRawService implements JobRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
