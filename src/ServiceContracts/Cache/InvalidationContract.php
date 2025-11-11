<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Cache;

use ImageKit\Cache\Invalidation\InvalidationCreateParams;
use ImageKit\Cache\Invalidation\InvalidationGetResponse;
use ImageKit\Cache\Invalidation\InvalidationNewResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

interface InvalidationContract
{
    /**
     * @api
     *
     * @param array<mixed>|InvalidationCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|InvalidationCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): InvalidationNewResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function get(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): InvalidationGetResponse;
}
