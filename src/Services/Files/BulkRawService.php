<?php

declare(strict_types=1);

namespace Imagekit\Services\Files;

use Imagekit\Client;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\Bulk\BulkAddTagsParams;
use Imagekit\Files\Bulk\BulkAddTagsResponse;
use Imagekit\Files\Bulk\BulkDeleteParams;
use Imagekit\Files\Bulk\BulkDeleteResponse;
use Imagekit\Files\Bulk\BulkRemoveAITagsParams;
use Imagekit\Files\Bulk\BulkRemoveAITagsResponse;
use Imagekit\Files\Bulk\BulkRemoveTagsParams;
use Imagekit\Files\Bulk\BulkRemoveTagsResponse;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Files\BulkRawContract;

final class BulkRawService implements BulkRawContract
{
    // @phpstan-ignore-next-line
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
     * @param array{fileIDs: list<string>}|BulkDeleteParams $params
     *
     * @return BaseResponse<BulkDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        array|BulkDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
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
     *   fileIDs: list<string>, tags: list<string>
     * }|BulkAddTagsParams $params
     *
     * @return BaseResponse<BulkAddTagsResponse>
     *
     * @throws APIException
     */
    public function addTags(
        array|BulkAddTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
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
     *   aiTags: list<string>, fileIDs: list<string>
     * }|BulkRemoveAITagsParams $params
     *
     * @return BaseResponse<BulkRemoveAITagsResponse>
     *
     * @throws APIException
     */
    public function removeAITags(
        array|BulkRemoveAITagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
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
     *   fileIDs: list<string>, tags: list<string>
     * }|BulkRemoveTagsParams $params
     *
     * @return BaseResponse<BulkRemoveTagsResponse>
     *
     * @throws APIException
     */
    public function removeTags(
        array|BulkRemoveTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
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
