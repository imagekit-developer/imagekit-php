<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Folders;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\Folders\Job\JobGetResponse;
use ImageKit\RequestOptions;

interface JobContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function get(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): JobGetResponse;
}
