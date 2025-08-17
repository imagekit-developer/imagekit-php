<?php

declare(strict_types=1);

namespace ImageKit\Folders\Job;

use ImageKit\Client;
use ImageKit\Contracts\Folders\JobContract;
use ImageKit\Core\Conversion;
use ImageKit\RequestOptions;
use ImageKit\Responses\Folders\Job\JobGetResponse;

final class JobService implements JobContract
{
    public function __construct(private Client $client) {}

    /**
     * This API returns the status of a bulk job like copy and move folder operations.
     */
    public function get(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): JobGetResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/bulkJobs/%1$s', $jobID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(JobGetResponse::class, value: $resp);
    }
}
