<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Folders\FolderCopyParams;
use Imagekit\Folders\FolderCopyResponse;
use Imagekit\Folders\FolderCreateParams;
use Imagekit\Folders\FolderDeleteParams;
use Imagekit\Folders\FolderDeleteResponse;
use Imagekit\Folders\FolderMoveParams;
use Imagekit\Folders\FolderMoveResponse;
use Imagekit\Folders\FolderNewResponse;
use Imagekit\Folders\FolderRenameParams;
use Imagekit\Folders\FolderRenameResponse;
use Imagekit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
interface FoldersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|FolderCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|FolderCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FolderDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        array|FolderDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FolderCopyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderCopyResponse>
     *
     * @throws APIException
     */
    public function copy(
        array|FolderCopyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FolderMoveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderMoveResponse>
     *
     * @throws APIException
     */
    public function move(
        array|FolderMoveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FolderRenameParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderRenameResponse>
     *
     * @throws APIException
     */
    public function rename(
        array|FolderRenameParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
