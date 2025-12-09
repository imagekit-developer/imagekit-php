<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Cache;

use Imagekit\Cache\Invalidation\InvalidationGetResponse;
use Imagekit\Cache\Invalidation\InvalidationNewResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;

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
        string $url,
        ?RequestOptions $requestOptions = null
    ): InvalidationNewResponse;

    /**
     * @api
     *
     * @param string $requestID should be a valid requestId
     *
     * @throws APIException
     */
    public function get(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): InvalidationGetResponse;
}
