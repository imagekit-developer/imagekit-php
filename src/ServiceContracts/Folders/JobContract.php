<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Folders;

use Imagekit\Core\Exceptions\APIException;
use Imagekit\Folders\Job\JobGetResponse;
use Imagekit\RequestOptions;

interface JobContract
{
    /**
     * @api
     *
     * @param string $jobID The `jobId` is returned in the response of bulk job API e.g. copy folder or move folder API.
     *
     * @throws APIException
     */
    public function get(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): JobGetResponse;
}
