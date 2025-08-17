<?php

declare(strict_types=1);

namespace ImageKit\Cache\Invalidation;

use ImageKit\Client;
use ImageKit\Contracts\Cache\InvalidationContract;
use ImageKit\Core\Conversion;
use ImageKit\RequestOptions;
use ImageKit\Responses\Cache\Invalidation\InvalidationGetResponse;
use ImageKit\Responses\Cache\Invalidation\InvalidationNewResponse;

final class InvalidationService implements InvalidationContract
{
    public function __construct(private Client $client) {}

    /**
     * This API will purge CDN cache and ImageKit.io's internal cache for a file.  Note: Purge cache is an asynchronous process and it may take some time to reflect the changes.
     *
     * @param array{url: string}|InvalidationCreateParams $params
     */
    public function create(
        array|InvalidationCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): InvalidationNewResponse {
        [$parsed, $options] = InvalidationCreateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/purge',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(InvalidationNewResponse::class, value: $resp);
    }

    /**
     * This API returns the status of a purge cache request.
     */
    public function get(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): InvalidationGetResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/files/purge/%1$s', $requestID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(InvalidationGetResponse::class, value: $resp);
    }
}
