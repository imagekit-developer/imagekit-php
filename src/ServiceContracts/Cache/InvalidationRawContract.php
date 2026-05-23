<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Cache;

use ImageKit\Cache\Invalidation\InvalidationCreateParams;
use ImageKit\Cache\Invalidation\InvalidationGetResponse;
use ImageKit\Cache\Invalidation\InvalidationNewResponse;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface InvalidationRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InvalidationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvalidationNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|InvalidationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $requestID should be a valid requestId
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvalidationGetResponse>
     *
     * @throws APIException
     */
    public function get(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
