<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Files;

use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Bulk\BulkAddTagsResponse;
use ImageKit\Responses\Files\Bulk\BulkDeleteResponse;
use ImageKit\Responses\Files\Bulk\BulkRemoveAITagsResponse;
use ImageKit\Responses\Files\Bulk\BulkRemoveTagsResponse;

interface BulkContract
{
    /**
     * @param list<string> $fileIDs an array of fileIds which you want to delete
     */
    public function delete(
        $fileIDs,
        ?RequestOptions $requestOptions = null
    ): BulkDeleteResponse;

    /**
     * @param list<string> $fileIDs an array of fileIds to which you want to add tags
     * @param list<string> $tags an array of tags that you want to add to the files
     */
    public function addTags(
        $fileIDs,
        $tags,
        ?RequestOptions $requestOptions = null
    ): BulkAddTagsResponse;

    /**
     * @param list<string> $aiTags an array of AITags that you want to remove from the files
     * @param list<string> $fileIDs an array of fileIds from which you want to remove AITags
     */
    public function removeAITags(
        $aiTags,
        $fileIDs,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveAITagsResponse;

    /**
     * @param list<string> $fileIDs an array of fileIds from which you want to remove tags
     * @param list<string> $tags an array of tags that you want to remove from the files
     */
    public function removeTags(
        $fileIDs,
        $tags,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveTagsResponse;
}
