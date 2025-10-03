<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Files;

use ImageKit\Core\Exceptions\APIException;
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
     *
     * @throws APIException
     */
    public function delete(
        $fileIDs,
        ?RequestOptions $requestOptions = null
    ): BulkDeleteResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function deleteRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): BulkDeleteResponse;

    /**
     * @api
     *
     * @param list<string> $fileIDs an array of fileIds to which you want to add tags
     * @param list<string> $tags an array of tags that you want to add to the files
     *
     * @throws APIException
     */
    public function addTags(
        $fileIDs,
        $tags,
        ?RequestOptions $requestOptions = null
    ): BulkAddTagsResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function addTagsRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): BulkAddTagsResponse;

    /**
     * @api
     *
     * @param list<string> $aiTags an array of AITags that you want to remove from the files
     * @param list<string> $fileIDs an array of fileIds from which you want to remove AITags
     *
     * @throws APIException
     */
    public function removeAITags(
        $aiTags,
        $fileIDs,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveAITagsResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function removeAITagsRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveAITagsResponse;

    /**
     * @api
     *
     * @param list<string> $fileIDs an array of fileIds from which you want to remove tags
     * @param list<string> $tags an array of tags that you want to remove from the files
     *
     * @throws APIException
     */
    public function removeTags(
        $fileIDs,
        $tags,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveTagsResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function removeTagsRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveTagsResponse;
}
