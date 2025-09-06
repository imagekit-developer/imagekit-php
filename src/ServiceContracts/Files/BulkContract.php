<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Files;

use ImageKit\Files\Bulk\BulkAddTagsResponse;
use ImageKit\Files\Bulk\BulkDeleteResponse;
use ImageKit\Files\Bulk\BulkRemoveAITagsResponse;
use ImageKit\Files\Bulk\BulkRemoveTagsResponse;
use ImageKit\RequestOptions;

interface BulkContract
{
    /**
     * @api
     *
     * @param list<string> $fileIDs an array of fileIds which you want to delete
     */
    public function delete(
        $fileIDs,
        ?RequestOptions $requestOptions = null
    ): BulkDeleteResponse;

    /**
     * @api
     *
     * @param list<string> $fileIDs an array of fileIds to which you want to add tags
     * @param list<string> $tags an array of tags that you want to add to the files
     */
    public function addTags(
        $fileIDs,
        $tags,
        ?RequestOptions $requestOptions = null
    ): BulkAddTagsResponse;

    /**
     * @api
     *
     * @param list<string> $aiTags an array of AITags that you want to remove from the files
     * @param list<string> $fileIDs an array of fileIds from which you want to remove AITags
     */
    public function removeAITags(
        $aiTags,
        $fileIDs,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveAITagsResponse;

    /**
     * @api
     *
     * @param list<string> $fileIDs an array of fileIds from which you want to remove tags
     * @param list<string> $tags an array of tags that you want to remove from the files
     */
    public function removeTags(
        $fileIDs,
        $tags,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveTagsResponse;
}
