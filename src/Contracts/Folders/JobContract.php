<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Folders;

use ImageKit\RequestOptions;
use ImageKit\Responses\Folders\Job\JobGetResponse;

interface JobContract
{
    public function get(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): JobGetResponse;
}
