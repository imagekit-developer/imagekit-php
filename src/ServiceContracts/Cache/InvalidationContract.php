<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Cache;

use ImageKit\Cache\Invalidation\InvalidationGetResponse;
use ImageKit\Cache\Invalidation\InvalidationNewResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

interface InvalidationContract
{
    /**
     * @api
     *
     * @param string $url the full URL of the file to be purged
     *
     * @throws APIException
     */
    public function create(
        $url,
        ?RequestOptions $requestOptions = null
    ): InvalidationNewResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
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
