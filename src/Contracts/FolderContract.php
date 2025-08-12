<?php

declare(strict_types=1);

namespace ImageKit\Contracts;

use ImageKit\Folder\FolderCreateParams;
use ImageKit\Folder\FolderDeleteParams;
use ImageKit\RequestOptions;

interface FolderContract
{
    /**
     * @param array{
     *   folderName: string, parentFolderPath: string
     * }|FolderCreateParams $params
     */
    public function create(
        array|FolderCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @param array{folderPath: string}|FolderDeleteParams $params
     */
    public function delete(
        array|FolderDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
