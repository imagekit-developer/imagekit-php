<?php

declare(strict_types=1);

namespace ImageKit\Core\ServiceContracts\Cache;

use ImageKit\Cache\Invalidation\InvalidationGetResponse;
use ImageKit\Cache\Invalidation\InvalidationNewResponse;
use ImageKit\RequestOptions;

interface InvalidationContract
{
    /**
     * @api
     *
     * @param string $url the full URL of the file to be purged
     */
    public function create(
        $url,
        ?RequestOptions $requestOptions = null
    ): InvalidationNewResponse;

    /**
     * @api
     */
    public function get(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): InvalidationGetResponse;
}
