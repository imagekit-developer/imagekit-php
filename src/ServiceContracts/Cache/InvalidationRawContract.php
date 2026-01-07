<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Cache;

use Imagekit\Cache\Invalidation\InvalidationCreateParams;
use Imagekit\Cache\Invalidation\InvalidationGetResponse;
use Imagekit\Cache\Invalidation\InvalidationNewResponse;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
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
