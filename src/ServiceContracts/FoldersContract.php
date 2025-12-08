<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

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

interface FoldersContract
{
    /**
     * @api
     *
     * @param array<mixed>|FolderCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|FolderCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderNewResponse;

    /**
     * @api
     *
     * @param array<mixed>|FolderDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        array|FolderDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderDeleteResponse;

    /**
     * @api
     *
     * @param array<mixed>|FolderCopyParams $params
     *
     * @throws APIException
     */
    public function copy(
        array|FolderCopyParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderCopyResponse;

    /**
     * @api
     *
     * @param array<mixed>|FolderMoveParams $params
     *
     * @throws APIException
     */
    public function move(
        array|FolderMoveParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderMoveResponse;

    /**
     * @api
     *
     * @param array<mixed>|FolderRenameParams $params
     *
     * @throws APIException
     */
    public function rename(
        array|FolderRenameParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderRenameResponse;
}
