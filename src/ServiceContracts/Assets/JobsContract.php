<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Assets;

use ImageKit\Assets\Jobs\JobGetResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface JobsContract
{
    /**
     * @api
     *
     * @param string $jobID the `job_id` returned by a bulk operation such as copy folder, move folder, or rename folder
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): JobGetResponse;
}
