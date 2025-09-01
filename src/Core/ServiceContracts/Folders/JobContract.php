<?php

declare(strict_types=1);

namespace ImageKit\Core\ServiceContracts\Folders;

use ImageKit\Folders\Job\JobGetResponse;
use ImageKit\RequestOptions;

interface JobContract
{
    /**
     * @api
     */
    public function get(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): JobGetResponse;
}
