<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Files;

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

interface BulkContract
{
    /**
     * @api
     *
     * @param array<mixed>|BulkDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        array|BulkDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkDeleteResponse;

    /**
     * @api
     *
     * @param array<mixed>|BulkAddTagsParams $params
     *
     * @throws APIException
     */
    public function addTags(
        array|BulkAddTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkAddTagsResponse;

    /**
     * @api
     *
     * @param array<mixed>|BulkRemoveAITagsParams $params
     *
     * @throws APIException
     */
    public function removeAITags(
        array|BulkRemoveAITagsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BulkRemoveAITagsResponse;

    /**
     * @api
     *
     * @param array<mixed>|BulkRemoveTagsParams $params
     *
     * @throws APIException
     */
    public function removeTags(
        array|BulkRemoveTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveTagsResponse;
}
