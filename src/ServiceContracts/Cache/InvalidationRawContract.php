<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Cache;

use Imagekit\Cache\Invalidation\InvalidationCreateParams;
use Imagekit\Cache\Invalidation\InvalidationGetResponse;
use Imagekit\Cache\Invalidation\InvalidationNewResponse;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;

interface InvalidationRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|InvalidationCreateParams $params
     *
     * @return BaseResponse<InvalidationNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|InvalidationCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $requestID should be a valid requestId
     *
     * @return BaseResponse<InvalidationGetResponse>
     *
     * @throws APIException
     */
    public function get(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
