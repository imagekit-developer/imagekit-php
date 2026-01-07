<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Cache;

use Imagekit\Cache\Invalidation\InvalidationGetResponse;
use Imagekit\Cache\Invalidation\InvalidationNewResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
interface InvalidationContract
{
    /**
     * @api
     *
     * @param string $url the full URL of the file to be purged
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $url,
        RequestOptions|array|null $requestOptions = null
    ): InvalidationNewResponse;

    /**
     * @api
     *
     * @param string $requestID should be a valid requestId
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): InvalidationGetResponse;
}
