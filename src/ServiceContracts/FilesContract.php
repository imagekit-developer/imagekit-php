<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\FileCopyParams;
use Imagekit\Files\FileCopyResponse;
use Imagekit\Files\FileMoveParams;
use Imagekit\Files\FileMoveResponse;
use Imagekit\Files\FileRenameParams;
use Imagekit\Files\FileRenameResponse;
use Imagekit\Files\FileUpdateResponse;
use Imagekit\Files\FileUploadParams;
use Imagekit\Files\FileUploadResponse;
use Imagekit\RequestOptions;

interface FilesContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function update(
        string $fileID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): FileUpdateResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|FileCopyParams $params
     *
     * @throws APIException
     */
    public function copy(
        array|FileCopyParams $params,
        ?RequestOptions $requestOptions = null
    ): FileCopyResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): File;

    /**
     * @api
     *
     * @param array<mixed>|FileMoveParams $params
     *
     * @throws APIException
     */
    public function move(
        array|FileMoveParams $params,
        ?RequestOptions $requestOptions = null
    ): FileMoveResponse;

    /**
     * @api
     *
     * @param array<mixed>|FileRenameParams $params
     *
     * @throws APIException
     */
    public function rename(
        array|FileRenameParams $params,
        ?RequestOptions $requestOptions = null
    ): FileRenameResponse;

    /**
     * @api
     *
     * @param array<mixed>|FileUploadParams $params
     *
     * @throws APIException
     */
    public function upload(
        array|FileUploadParams $params,
        ?RequestOptions $requestOptions = null
    ): FileUploadResponse;
}
