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

interface FoldersRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|FolderCreateParams $params
     *
     * @return BaseResponse<FolderNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|FolderCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|FolderDeleteParams $params
     *
     * @return BaseResponse<FolderDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        array|FolderDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|FolderCopyParams $params
     *
     * @return BaseResponse<FolderCopyResponse>
     *
     * @throws APIException
     */
    public function copy(
        array|FolderCopyParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|FolderMoveParams $params
     *
     * @return BaseResponse<FolderMoveResponse>
     *
     * @throws APIException
     */
    public function move(
        array|FolderMoveParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|FolderRenameParams $params
     *
     * @return BaseResponse<FolderRenameResponse>
     *
     * @throws APIException
     */
    public function rename(
        array|FolderRenameParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
