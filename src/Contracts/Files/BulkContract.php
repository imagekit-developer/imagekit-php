<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Files;

use ImageKit\Files\Bulk\BulkAddTagsParams;
use ImageKit\Files\Bulk\BulkDeleteParams;
use ImageKit\Files\Bulk\BulkRemoveAITagsParams;
use ImageKit\Files\Bulk\BulkRemoveTagsParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Bulk\BulkAddTagsResponse;
use ImageKit\Responses\Files\Bulk\BulkDeleteResponse;
use ImageKit\Responses\Files\Bulk\BulkRemoveAITagsResponse;
use ImageKit\Responses\Files\Bulk\BulkRemoveTagsResponse;

interface BulkContract
{
    /**
     * @param array{fileIDs: list<string>}|BulkDeleteParams $params
     */
    public function delete(
        array|BulkDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkDeleteResponse;

    /**
     * @param array{
     *   fileIDs: list<string>, tags: list<string>
     * }|BulkAddTagsParams $params
     */
    public function addTags(
        array|BulkAddTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkAddTagsResponse;

    /**
     * @param array{
     *   aiTags: list<string>, fileIDs: list<string>
     * }|BulkRemoveAITagsParams $params
     */
    public function removeAITags(
        array|BulkRemoveAITagsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BulkRemoveAITagsResponse;

    /**
     * @param array{
     *   fileIDs: list<string>, tags: list<string>
     * }|BulkRemoveTagsParams $params
     */
    public function removeTags(
        array|BulkRemoveTagsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BulkRemoveTagsResponse;
}
