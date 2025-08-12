<?php

declare(strict_types=1);

namespace ImageKit\Files\Batch;

use ImageKit\Client;
use ImageKit\Contracts\Files\BatchContract;
use ImageKit\Core\Conversion;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Batch\BatchDeleteResponse;

final class BatchService implements BatchContract
{
    public function __construct(private Client $client) {}

    /**
     * This API deletes multiple files and all their file versions permanently.
     *
     * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using purge cache API.
     *
     * A maximum of 100 files can be deleted at a time.
     *
     * @param array{fileIDs: list<string>}|BatchDeleteParams $params
     */
    public function delete(
        array|BatchDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): BatchDeleteResponse {
        [$parsed, $options] = BatchDeleteParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/batch/deleteByFileIds',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BatchDeleteResponse::class, value: $resp);
    }
}
