<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\Folders\FolderCopyParams;
use ImageKit\Folders\FolderCopyResponse;
use ImageKit\Folders\FolderCreateParams;
use ImageKit\Folders\FolderDeleteParams;
use ImageKit\Folders\FolderDeleteResponse;
use ImageKit\Folders\FolderMoveParams;
use ImageKit\Folders\FolderMoveResponse;
use ImageKit\Folders\FolderNewResponse;
use ImageKit\Folders\FolderRenameParams;
use ImageKit\Folders\FolderRenameResponse;
use ImageKit\RequestOptions;

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
