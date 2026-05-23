<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts;

use ImageKit\Core\Contracts\BaseResponse;
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

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
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
