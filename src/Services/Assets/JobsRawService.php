<?php

declare(strict_types=1);

namespace ImageKit\Services\Assets;

use ImageKit\Assets\Jobs\JobGetResponse;
use ImageKit\Client;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Assets\JobsRawContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class JobsRawService implements JobsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the status of a bulk job such as a copy, move, or rename folder operation.
     *
     * @param string $jobID the `job_id` returned by a bulk operation such as copy folder, move folder, or rename folder
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JobGetResponse>
     *
     * @throws APIException
     */
    public function get(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v2/assets/jobs/%1$s', $jobID],
            options: $requestOptions,
            convert: JobGetResponse::class,
        );
    }
}
