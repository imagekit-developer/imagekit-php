<?php

declare(strict_types=1);

namespace ImageKit\Files\Bulk;

use ImageKit\Client;
use ImageKit\Contracts\Files\BulkContract;
use ImageKit\Core\Conversion;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Bulk\BulkAddTagsResponse;
use ImageKit\Responses\Files\Bulk\BulkDeleteResponse;
use ImageKit\Responses\Files\Bulk\BulkRemoveAITagsResponse;
use ImageKit\Responses\Files\Bulk\BulkRemoveTagsResponse;

final class BulkService implements BulkContract
{
    public function __construct(private Client $client) {}

    /**
     * This API deletes multiple files and all their file versions permanently.
     *
     * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using purge cache API.
     *
     * A maximum of 100 files can be deleted at a time.
     *
     * @param array{fileIDs: list<string>}|BulkDeleteParams $params
     */
    public function delete(
        array|BulkDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkDeleteResponse {
        [$parsed, $options] = BulkDeleteParams::parseRequest(
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
        return Conversion::coerce(BulkDeleteResponse::class, value: $resp);
    }

    /**
     * This API adds tags to multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param array{
     *   fileIDs: list<string>, tags: list<string>
     * }|BulkAddTagsParams $params
     */
    public function addTags(
        array|BulkAddTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkAddTagsResponse {
        [$parsed, $options] = BulkAddTagsParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/addTags',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BulkAddTagsResponse::class, value: $resp);
    }

    /**
     * This API removes AITags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param array{
     *   aiTags: list<string>, fileIDs: list<string>
     * }|BulkRemoveAITagsParams $params
     */
    public function removeAITags(
        array|BulkRemoveAITagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveAITagsResponse {
        [$parsed, $options] = BulkRemoveAITagsParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/removeAITags',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BulkRemoveAITagsResponse::class, value: $resp);
    }

    /**
     * This API removes tags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param array{
     *   fileIDs: list<string>, tags: list<string>
     * }|BulkRemoveTagsParams $params
     */
    public function removeTags(
        array|BulkRemoveTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveTagsResponse {
        [$parsed, $options] = BulkRemoveTagsParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/removeTags',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BulkRemoveTagsResponse::class, value: $resp);
    }
}
