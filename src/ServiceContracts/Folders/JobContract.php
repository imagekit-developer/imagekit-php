<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Folders;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Implementation\HasRawResponse;
use ImageKit\Folders\Job\JobGetResponse;
use ImageKit\RequestOptions;

interface JobContract
{
    /**
     * @api
     *
     * @return JobGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function get(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): JobGetResponse;

    /**
     * @api
     *
     * @return JobGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function getRaw(
        string $jobID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): JobGetResponse;
}
