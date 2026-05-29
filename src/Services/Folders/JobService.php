<?php

declare(strict_types=1);

namespace ImageKit\Services\Folders;

use ImageKit\Client;
use ImageKit\ServiceContracts\Folders\JobContract;

final class JobService implements JobContract
{
    /**
     * @api
     */
    public JobRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new JobRawService($client);
    }
}
