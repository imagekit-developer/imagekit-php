<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Cache;

use ImageKit\Cache\Invalidation\InvalidationNewResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
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
}
