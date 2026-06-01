<?php

declare(strict_types=1);

namespace ImageKit\Services\Assets;

use ImageKit\Assets\Jobs\JobGetResponse;
use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Assets\JobsContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class JobsService implements JobsContract
{
    /**
     * @api
     */
    public JobsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new JobsRawService($client);
    }

    /**
     * @api
     *
     * Returns the status of a bulk job such as a copy, move, or rename folder operation.
     *
     * @param string $jobID the `job_id` returned by a bulk operation such as copy folder, move folder, or rename folder
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
