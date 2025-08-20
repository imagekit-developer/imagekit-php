<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Cache;

use ImageKit\RequestOptions;
use ImageKit\Responses\Cache\Invalidation\InvalidationGetResponse;
use ImageKit\Responses\Cache\Invalidation\InvalidationNewResponse;

interface InvalidationContract
{
    /**
     * @param string $url the full URL of the file to be purged
     */
    public function create(
        $url,
        ?RequestOptions $requestOptions = null
    ): InvalidationNewResponse;

    public function get(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): InvalidationGetResponse;
}
