<?php

declare(strict_types=1);

namespace ImageKit\Services\Files;

use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Files\Bulk\BulkAddTagsParams;
use ImageKit\Files\Bulk\BulkAddTagsResponse;
use ImageKit\Files\Bulk\BulkDeleteParams;
use ImageKit\Files\Bulk\BulkDeleteResponse;
use ImageKit\Files\Bulk\BulkRemoveAITagsParams;
use ImageKit\Files\Bulk\BulkRemoveAITagsResponse;
use ImageKit\Files\Bulk\BulkRemoveTagsParams;
use ImageKit\Files\Bulk\BulkRemoveTagsResponse;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Files\BulkContract;

final class BulkService implements BulkContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This API deletes multiple files and all their file versions permanently.
     *
     * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using purge cache API.
     *
     * A maximum of 100 files can be deleted at a time.
     *
     * @param array{fileIds: list<string>}|BulkDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        array|BulkDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkDeleteResponse {
        [$parsed, $options] = BulkDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/files/batch/deleteByFileIds',
            body: (object) $parsed,
            options: $options,
            convert: BulkDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * This API adds tags to multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param array{
     *   fileIds: list<string>, tags: list<string>
     * }|BulkAddTagsParams $params
     *
     * @throws APIException
     */
    public function addTags(
        array|BulkAddTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkAddTagsResponse {
        [$parsed, $options] = BulkAddTagsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/files/addTags',
            body: (object) $parsed,
            options: $options,
            convert: BulkAddTagsResponse::class,
        );
    }

    /**
     * @api
     *
     * This API removes AITags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param array{
     *   AITags: list<string>, fileIds: list<string>
     * }|BulkRemoveAITagsParams $params
     *
     * @throws APIException
     */
    public function removeAITags(
        array|BulkRemoveAITagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveAITagsResponse {
        [$parsed, $options] = BulkRemoveAITagsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/files/removeAITags',
            body: (object) $parsed,
            options: $options,
            convert: BulkRemoveAITagsResponse::class,
        );
    }

    /**
     * @api
     *
     * This API removes tags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param array{
     *   fileIds: list<string>, tags: list<string>
     * }|BulkRemoveTagsParams $params
     *
     * @throws APIException
     */
    public function removeTags(
        array|BulkRemoveTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveTagsResponse {
        [$parsed, $options] = BulkRemoveTagsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/files/removeTags',
            body: (object) $parsed,
            options: $options,
            convert: BulkRemoveTagsResponse::class,
        );
    }
}
