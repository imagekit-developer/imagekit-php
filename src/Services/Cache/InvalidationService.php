<?php

declare(strict_types=1);

namespace ImageKit\Services\Cache;

use ImageKit\Cache\Invalidation\InvalidationCreateParams;
use ImageKit\Cache\Invalidation\InvalidationGetResponse;
use ImageKit\Cache\Invalidation\InvalidationNewResponse;
use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Cache\InvalidationContract;

final class InvalidationService implements InvalidationContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
        $url,
        ?RequestOptions $requestOptions = null
    ): InvalidationNewResponse {
        $params = ['url' => $url];

        return $this->createRaw($params, $requestOptions);
    }

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
    ): InvalidationNewResponse {
        [$parsed, $options] = InvalidationCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'v1/files/purge',
            body: (object) $parsed,
            options: $options,
            convert: InvalidationNewResponse::class,
        );
    }

    /**
     * @api
     *
     * This API returns the status of a purge cache request.
     *
     * @throws APIException
     */
    public function get(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): InvalidationGetResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['v1/files/purge/%1$s', $requestID],
            options: $requestOptions,
            convert: InvalidationGetResponse::class,
        );
    }
}
