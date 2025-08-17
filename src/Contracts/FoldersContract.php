<?php

declare(strict_types=1);

namespace ImageKit\Contracts;

use ImageKit\Folders\FolderCopyParams;
use ImageKit\Folders\FolderCreateParams;
use ImageKit\Folders\FolderDeleteParams;
use ImageKit\Folders\FolderMoveParams;
use ImageKit\Folders\FolderRenameParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Folders\FolderCopyResponse;
use ImageKit\Responses\Folders\FolderDeleteResponse;
use ImageKit\Responses\Folders\FolderMoveResponse;
use ImageKit\Responses\Folders\FolderNewResponse;
use ImageKit\Responses\Folders\FolderRenameResponse;

interface FoldersContract
{
    /**
     * @param array{
     *   folderName: string, parentFolderPath: string
     * }|FolderCreateParams $params
     */
    public function create(
        array|FolderCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderNewResponse;

    /**
     * @param array{folderPath: string}|FolderDeleteParams $params
     */
    public function delete(
        array|FolderDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderDeleteResponse;

    /**
     * @param array{
     *   destinationPath: string, sourceFolderPath: string, includeVersions?: bool
     * }|FolderCopyParams $params
     */
    public function copy(
        array|FolderCopyParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderCopyResponse;

    /**
     * @param array{
     *   destinationPath: string, sourceFolderPath: string
     * }|FolderMoveParams $params
     */
    public function move(
        array|FolderMoveParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderMoveResponse;

    /**
     * @param array{
     *   folderPath: string, newFolderName: string, purgeCache?: bool
     * }|FolderRenameParams $params
     */
    public function rename(
        array|FolderRenameParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderRenameResponse;
}
