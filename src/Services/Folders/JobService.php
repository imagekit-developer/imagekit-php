<?php

declare(strict_types=1);

namespace ImageKit\Services\Folders;

use ImageKit\Client;
use ImageKit\Folders\Job\JobGetResponse;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Folders\JobContract;

final class JobService implements JobContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This API returns the status of a bulk job like copy and move folder operations.
     */
    public function get(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): JobGetResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['v1/bulkJobs/%1$s', $jobID],
            options: $requestOptions,
            convert: JobGetResponse::class,
        );
    }
}
