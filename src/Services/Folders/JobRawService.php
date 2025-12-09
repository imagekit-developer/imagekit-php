<?php

declare(strict_types=1);

namespace Imagekit\Services\Folders;

use Imagekit\Client;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Folders\Job\JobGetResponse;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Folders\JobRawContract;

final class JobRawService implements JobRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This API returns the status of a bulk job like copy and move folder operations.
     *
     * @param string $jobID The `jobId` is returned in the response of bulk job API e.g. copy folder or move folder API.
     *
     * @return BaseResponse<JobGetResponse>
     *
     * @throws APIException
     */
    public function get(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/bulkJobs/%1$s', $jobID],
            options: $requestOptions,
            convert: JobGetResponse::class,
        );
    }
}
