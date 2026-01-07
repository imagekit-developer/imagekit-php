<?php

declare(strict_types=1);

namespace Imagekit\Services\Folders;

use Imagekit\Client;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Folders\Job\JobGetResponse;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Folders\JobContract;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
final class JobService implements JobContract
{
    /**
     * @api
     */
    public JobRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new JobRawService($client);
    }

    /**
     * @api
     *
     * This API returns the status of a bulk job like copy and move folder operations.
     *
     * @param string $jobID The `jobId` is returned in the response of bulk job API e.g. copy folder or move folder API.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): JobGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get($jobID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
