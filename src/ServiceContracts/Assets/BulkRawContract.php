<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Assets;

use ImageKit\Assets\Bulk\BulkAddTagsParams;
use ImageKit\Assets\Bulk\BulkDeleteParams;
use ImageKit\Assets\Bulk\BulkDeleteResponse;
use ImageKit\Assets\Bulk\BulkRemoveTagsParams;
use ImageKit\Assets\BulkTagUpdateResult;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
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
     * @return BaseResponse<BulkTagUpdateResult>
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
     * @param array<string,mixed>|BulkRemoveTagsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkTagUpdateResult>
     *
     * @throws APIException
     */
    public function removeTags(
        array|BulkRemoveTagsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
