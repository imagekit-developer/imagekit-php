<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\FileCopyParams;
use Imagekit\Files\FileCopyResponse;
use Imagekit\Files\FileMoveParams;
use Imagekit\Files\FileMoveResponse;
use Imagekit\Files\FileRenameParams;
use Imagekit\Files\FileRenameResponse;
use Imagekit\Files\FileUpdateParams;
use Imagekit\Files\FileUpdateResponse;
use Imagekit\Files\FileUploadParams;
use Imagekit\Files\FileUploadResponse;
use Imagekit\RequestOptions;

interface FilesRawContract
{
    /**
     * @api
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     * @param array<string,mixed>|FileUpdateParams $params
     *
     * @return BaseResponse<FileUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $fileID,
        array|FileUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FileCopyParams $params
     *
     * @return BaseResponse<FileCopyResponse>
     *
     * @throws APIException
     */
    public function copy(
        array|FileCopyParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in the list and search assets API and upload API.
     *
     * @return BaseResponse<File>
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FileMoveParams $params
     *
     * @return BaseResponse<FileMoveResponse>
     *
     * @throws APIException
     */
    public function move(
        array|FileMoveParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FileRenameParams $params
     *
     * @return BaseResponse<FileRenameResponse>
     *
     * @throws APIException
     */
    public function rename(
        array|FileRenameParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FileUploadParams $params
     *
     * @return BaseResponse<FileUploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        array|FileUploadParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
