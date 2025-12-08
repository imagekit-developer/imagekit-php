<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Cache;

use Imagekit\Cache\Invalidation\InvalidationCreateParams;
use Imagekit\Cache\Invalidation\InvalidationGetResponse;
use Imagekit\Cache\Invalidation\InvalidationNewResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;

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
