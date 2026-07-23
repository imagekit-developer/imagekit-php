<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Files;

use ImageKit\Core\Contracts\BaseResponse;
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

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface BulkRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BulkDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        array|BulkDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BulkAddTagsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkAddTagsResponse>
     *
     * @throws APIException
     */
    public function addTags(
        array|BulkAddTagsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BulkRemoveAITagsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkRemoveAITagsResponse>
     *
     * @throws APIException
     */
    public function removeAITags(
        array|BulkRemoveAITagsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BulkRemoveTagsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkRemoveTagsResponse>
     *
     * @throws APIException
     */
    public function removeTags(
        array|BulkRemoveTagsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
