<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Cache;

use ImageKit\Cache\Invalidation\InvalidationCreateParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Cache\Invalidation\InvalidationGetResponse;
use ImageKit\Responses\Cache\Invalidation\InvalidationNewResponse;

interface InvalidationContract
{
    /**
     * @param array{url: string}|InvalidationCreateParams $params
     */
    public function create(
        array|InvalidationCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): InvalidationNewResponse;

    public function get(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): InvalidationGetResponse;
}
