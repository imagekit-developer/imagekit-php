<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Folders;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\Folders\Job\JobGetResponse;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface JobContract
{
    /**
     * @api
     *
     * @param string $jobID The `jobId` is returned in the response of bulk job API e.g. copy folder or move folder API.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): JobGetResponse;
}
