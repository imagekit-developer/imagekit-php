<?php

declare(strict_types=1);

namespace Imagekit\Services\Folders;

use Imagekit\Client;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Folders\Job\JobGetResponse;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Folders\JobContract;

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
     * @throws APIException
     */
    public function get(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): JobGetResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/bulkJobs/%1$s', $jobID],
            options: $requestOptions,
            convert: JobGetResponse::class,
        );
    }
}
