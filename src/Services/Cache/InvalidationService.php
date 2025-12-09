<?php

declare(strict_types=1);

namespace Imagekit\Services\Cache;

use Imagekit\Cache\Invalidation\InvalidationGetResponse;
use Imagekit\Cache\Invalidation\InvalidationNewResponse;
use Imagekit\Client;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Cache\InvalidationContract;

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
     *
     * @throws APIException
     */
    public function create(
        string $url,
        ?RequestOptions $requestOptions = null
    ): InvalidationNewResponse {
        $params = ['url' => $url];

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
     *
     * @throws APIException
     */
    public function get(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): InvalidationGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get($requestID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
