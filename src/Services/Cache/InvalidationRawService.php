<?php

declare(strict_types=1);

namespace ImageKit\Services\Cache;

use ImageKit\Cache\Invalidation\InvalidationCreateParams;
use ImageKit\Cache\Invalidation\InvalidationGetResponse;
use ImageKit\Cache\Invalidation\InvalidationNewResponse;
use ImageKit\Client;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Cache\InvalidationRawContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class InvalidationRawService implements InvalidationRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This API will invalidate CDN cache and ImageKit.io's internal cache for an asset.  Note: Purge cache is an asynchronous process and it may take some time to reflect the changes.
     *
     * @param array{assetURL: string}|InvalidationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvalidationNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|InvalidationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InvalidationCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v2/cache/invalidations',
            body: (object) $parsed,
            options: $options,
            convert: InvalidationNewResponse::class,
        );
    }

    /**
     * @api
     *
     * This API returns the status of a cache invalidation request.
     *
     * @param string $requestID should be a valid request_id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvalidationGetResponse>
     *
     * @throws APIException
     */
    public function get(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v2/cache/invalidations/%1$s', $requestID],
            options: $requestOptions,
            convert: InvalidationGetResponse::class,
        );
    }
}
