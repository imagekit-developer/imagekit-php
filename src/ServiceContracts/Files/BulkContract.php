<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Files;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\Files\Bulk\BulkAddTagsResponse;
use ImageKit\Files\Bulk\BulkDeleteResponse;
use ImageKit\Files\Bulk\BulkRemoveAITagsResponse;
use ImageKit\Files\Bulk\BulkRemoveTagsResponse;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface BulkContract
{
    /**
     * @api
     *
     * @param list<string> $fileIDs an array of fileIds which you want to delete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        array $fileIDs,
        RequestOptions|array|null $requestOptions = null
    ): BulkDeleteResponse;

    /**
     * @api
     *
     * @param list<string> $fileIDs an array of fileIds to which you want to add tags
     * @param list<string> $tags an array of tags that you want to add to the files
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function addTags(
        array $fileIDs,
        array $tags,
        RequestOptions|array|null $requestOptions = null,
    ): BulkAddTagsResponse;

    /**
     * @api
     *
     * @param list<string> $aiTags an array of AITags that you want to remove from the files
     * @param list<string> $fileIDs an array of fileIds from which you want to remove AITags
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function removeAITags(
        array $aiTags,
        array $fileIDs,
        RequestOptions|array|null $requestOptions = null,
    ): BulkRemoveAITagsResponse;

    /**
     * @api
     *
     * @param list<string> $fileIDs an array of fileIds from which you want to remove tags
     * @param list<string> $tags an array of tags that you want to remove from the files
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function removeTags(
        array $fileIDs,
        array $tags,
        RequestOptions|array|null $requestOptions = null,
    ): BulkRemoveTagsResponse;
}
