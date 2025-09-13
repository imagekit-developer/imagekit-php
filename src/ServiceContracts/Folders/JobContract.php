<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Folders;

use ImageKit\Core\Implementation\HasRawResponse;
use ImageKit\Folders\Job\JobGetResponse;
use ImageKit\RequestOptions;

interface JobContract
{
    /**
     * @api
     *
     * @return JobGetResponse<HasRawResponse>
     */
    public function get(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): JobGetResponse;
}
