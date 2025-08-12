<?php

declare(strict_types=1);

namespace ImageKit\Files\Purge;

use ImageKit\Client;
use ImageKit\Contracts\Files\PurgeContract;
use ImageKit\Core\Conversion;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Purge\PurgeExecuteResponse;
use ImageKit\Responses\Files\Purge\PurgeStatusResponse;

final class PurgeService implements PurgeContract
{
    public function __construct(private Client $client) {}

    /**
     * This API will purge CDN cache and ImageKit.io's internal cache for a file.  Note: Purge cache is an asynchronous process and it may take some time to reflect the changes.
     *
     * @param array{url: string}|PurgeExecuteParams $params
     */
    public function execute(
        array|PurgeExecuteParams $params,
        ?RequestOptions $requestOptions = null
    ): PurgeExecuteResponse {
        [$parsed, $options] = PurgeExecuteParams::parseRequest(
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
        return Conversion::coerce(PurgeExecuteResponse::class, value: $resp);
    }

    /**
     * This API returns the status of a purge cache request.
     */
    public function status(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): PurgeStatusResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/files/purge/%1$s', $requestID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(PurgeStatusResponse::class, value: $resp);
    }
}
