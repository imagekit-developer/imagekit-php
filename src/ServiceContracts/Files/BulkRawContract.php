<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Files;

use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\Bulk\BulkAddTagsParams;
use Imagekit\Files\Bulk\BulkAddTagsResponse;
use Imagekit\Files\Bulk\BulkDeleteParams;
use Imagekit\Files\Bulk\BulkDeleteResponse;
use Imagekit\Files\Bulk\BulkRemoveAITagsParams;
use Imagekit\Files\Bulk\BulkRemoveAITagsResponse;
use Imagekit\Files\Bulk\BulkRemoveTagsParams;
use Imagekit\Files\Bulk\BulkRemoveTagsResponse;
use Imagekit\RequestOptions;

interface BulkRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|BulkDeleteParams $params
     *
     * @return BaseResponse<BulkDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        array|BulkDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|BulkAddTagsParams $params
     *
     * @return BaseResponse<BulkAddTagsResponse>
     *
     * @throws APIException
     */
    public function addTags(
        array|BulkAddTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|BulkRemoveAITagsParams $params
     *
     * @return BaseResponse<BulkRemoveAITagsResponse>
     *
     * @throws APIException
     */
    public function removeAITags(
        array|BulkRemoveAITagsParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|BulkRemoveTagsParams $params
     *
     * @return BaseResponse<BulkRemoveTagsResponse>
     *
     * @throws APIException
     */
    public function removeTags(
        array|BulkRemoveTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
