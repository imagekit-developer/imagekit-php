<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Folders;

use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Folders\Job\JobGetResponse;
use Imagekit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
interface JobRawContract
{
    /**
     * @api
     *
     * @param string $jobID The `jobId` is returned in the response of bulk job API e.g. copy folder or move folder API.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JobGetResponse>
     *
     * @throws APIException
     */
    public function get(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
