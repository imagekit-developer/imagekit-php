<?php

declare(strict_types=1);

namespace ImageKit\Services\Assets;

use ImageKit\Assets\Bulk\BulkDeleteResponse;
use ImageKit\Assets\BulkTagUpdateResult;
use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Util;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Assets\BulkContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class BulkService implements BulkContract
{
    /**
     * @api
     */
    public BulkRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BulkRawService($client);
    }

    /**
     * @api
     *
     * Permanently deletes multiple assets — files (including all of their versions) and folders (including their contents) — in a single request. Identify each asset by its `asset_id`.
     *
     * A maximum of 100 assets can be deleted in one request.
     *
     * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting an asset does not purge the cache. Use the purge cache API to purge cached URLs.
     *
     * @param list<string> $assetIDs An array of asset ids to delete. Each id can refer to a file or a folder, as returned by the list and search assets, upload, or create folder APIs.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        array $assetIDs,
        RequestOptions|array|null $requestOptions = null
    ): BulkDeleteResponse {
        $params = Util::removeNulls(['assetIDs' => $assetIDs]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Adds one or more tags to multiple files in a single call. A maximum of 50 files can be specified per request.
     *
     * Tags are merged with any tags already present on each file; duplicates are ignored.
     *
     * @param list<string> $assetIDs array of file `asset_id`s to which the tags will be added
     * @param list<string> $tags Array of tags to add. Combined length of all tags must not exceed 500 characters.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function addTags(
        array $assetIDs,
        array $tags,
        RequestOptions|array|null $requestOptions = null,
    ): BulkTagUpdateResult {
        $params = Util::removeNulls(['assetIDs' => $assetIDs, 'tags' => $tags]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->addTags(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Removes user-applied tags and/or AI-generated tags from multiple files in a single call. A maximum of 50 files can be specified per request.
     *
     * At least one of `tags` or `ai_tags` must be provided. Both may be specified together; each list is removed from the corresponding tag set on every file. Tags that are not present on a file are silently ignored.
     *
     * @param list<string> $assetIDs array of file `asset_id`s from which the tags will be removed
     * @param list<string> $aiTags AI-generated tags to remove from each file
     * @param list<string> $tags user-applied tags to remove from each file
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function removeTags(
        array $assetIDs,
        ?array $aiTags = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): BulkTagUpdateResult {
        $params = Util::removeNulls(
            ['assetIDs' => $assetIDs, 'aiTags' => $aiTags, 'tags' => $tags]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->removeTags(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
