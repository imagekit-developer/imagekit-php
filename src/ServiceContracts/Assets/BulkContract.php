<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Assets;

use ImageKit\Assets\Bulk\BulkDeleteResponse;
use ImageKit\Assets\BulkTagUpdateResult;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface BulkContract
{
    /**
     * @api
     *
     * @param list<string> $assetIDs An array of asset ids to delete. Each id can refer to a file or a folder, as returned by the list and search assets, upload, or create folder APIs.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        array $assetIDs,
        RequestOptions|array|null $requestOptions = null
    ): BulkDeleteResponse;

    /**
     * @api
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
    ): BulkTagUpdateResult;

    /**
     * @api
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
    ): BulkTagUpdateResult;
}
