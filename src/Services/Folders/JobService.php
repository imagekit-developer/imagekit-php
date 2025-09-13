<?php

declare(strict_types=1);

namespace ImageKit\Services\Folders;

use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Implementation\HasRawResponse;
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
     *
     * @return JobGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function get(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): JobGetResponse {
        $params = [];

        return $this->getRaw($jobID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return JobGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function getRaw(
        string $jobID,
        mixed $params,
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
