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

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
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
