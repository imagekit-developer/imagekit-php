<?php

declare(strict_types=1);

namespace ImageKit\Services\Assets;

use ImageKit\Assets\Bulk\BulkAddTagsParams;
use ImageKit\Assets\Bulk\BulkDeleteParams;
use ImageKit\Assets\Bulk\BulkDeleteResponse;
use ImageKit\Assets\Bulk\BulkRemoveTagsParams;
use ImageKit\Assets\BulkTagUpdateResult;
use ImageKit\Client;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Assets\BulkRawContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
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
     * Permanently deletes multiple assets — files (including all of their versions) and folders (including their contents) — in a single request. Identify each asset by its `asset_id`.
     *
     * A maximum of 100 assets can be deleted in one request.
     *
     * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting an asset does not purge the cache. Use the purge cache API to purge cached URLs.
     *
     * @param array{assetIDs: list<string>}|BulkDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        array|BulkDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BulkDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: 'v2/assets',
            body: (object) $parsed,
            options: $options,
            convert: BulkDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Adds one or more tags to multiple files in a single call. A maximum of 50 files can be specified per request.
     *
     * Tags are merged with any tags already present on each file; duplicates are ignored.
     *
     * @param array{
     *   assetIDs: list<string>, tags: list<string>
     * }|BulkAddTagsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkTagUpdateResult>
     *
     * @throws APIException
     */
    public function addTags(
        array|BulkAddTagsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BulkAddTagsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v2/assets/tags',
            body: (object) $parsed,
            options: $options,
            convert: BulkTagUpdateResult::class,
        );
    }

    /**
     * @api
     *
     * Removes user-applied tags and/or AI-generated tags from multiple files in a single call. A maximum of 50 files can be specified per request.
     *
     * At least one of `tags` or `ai_tags` must be provided. Both may be specified together; each list is removed from the corresponding tag set on every file. Tags that are not present on a file are silently ignored.
     *
     * @param array{
     *   assetIDs: list<string>, aiTags?: list<string>, tags?: list<string>
     * }|BulkRemoveTagsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkTagUpdateResult>
     *
     * @throws APIException
     */
    public function removeTags(
        array|BulkRemoveTagsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BulkRemoveTagsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: 'v2/assets/tags',
            body: (object) $parsed,
            options: $options,
            convert: BulkTagUpdateResult::class,
        );
    }
}
