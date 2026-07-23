<?php

declare(strict_types=1);

namespace ImageKit\Services\Cache;

use ImageKit\Cache\Invalidation\InvalidationGetResponse;
use ImageKit\Cache\Invalidation\InvalidationNewResponse;
use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Util;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Cache\InvalidationContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class InvalidationService implements InvalidationContract
{
    /**
     * @api
     */
    public InvalidationRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InvalidationRawService($client);
    }

    /**
     * @api
     *
     * This API will purge CDN cache and ImageKit.io's internal cache for a file.  Note: Purge cache is an asynchronous process and it may take some time to reflect the changes.
     *
     * @param string $url the full URL of the file to be purged
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $url,
        RequestOptions|array|null $requestOptions = null
    ): InvalidationNewResponse {
        $params = Util::removeNulls(['url' => $url]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API returns the status of a purge cache request.
     *
     * @param string $requestID should be a valid requestId
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): InvalidationGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get($requestID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
