<?php

declare(strict_types=1);

namespace Imagekit\Services\Cache;

use Imagekit\Cache\Invalidation\InvalidationCreateParams;
use Imagekit\Cache\Invalidation\InvalidationGetResponse;
use Imagekit\Cache\Invalidation\InvalidationNewResponse;
use Imagekit\Client;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Cache\InvalidationContract;

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
     * @param array{url: string}|InvalidationCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|InvalidationCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): InvalidationNewResponse {
        [$parsed, $options] = InvalidationCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<InvalidationNewResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'v1/files/purge',
            body: (object) $parsed,
            options: $options,
            convert: InvalidationNewResponse::class,
        );

        return $response->parse();
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
        /** @var BaseResponse<InvalidationGetResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['v1/files/purge/%1$s', $requestID],
            options: $requestOptions,
            convert: InvalidationGetResponse::class,
        );

        return $response->parse();
    }
}
