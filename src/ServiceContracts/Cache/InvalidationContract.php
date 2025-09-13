<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Cache;

use ImageKit\Cache\Invalidation\InvalidationGetResponse;
use ImageKit\Cache\Invalidation\InvalidationNewResponse;
use ImageKit\Core\Implementation\HasRawResponse;
use ImageKit\RequestOptions;

interface InvalidationContract
{
    /**
     * @api
     *
     * @param string $url the full URL of the file to be purged
     *
     * @return InvalidationNewResponse<HasRawResponse>
     */
    public function create(
        $url,
        ?RequestOptions $requestOptions = null
    ): InvalidationNewResponse;

    /**
     * @api
     *
     * @return InvalidationGetResponse<HasRawResponse>
     */
    public function get(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): InvalidationGetResponse;
}
