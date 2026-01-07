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

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
interface FilesRawContract
{
    /**
     * @api
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     * @param array<string,mixed>|FileUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $fileID,
        array|FileUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FileCopyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileCopyResponse>
     *
     * @throws APIException
     */
    public function copy(
        array|FileCopyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in the list and search assets API and upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<File>
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FileMoveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileMoveResponse>
     *
     * @throws APIException
     */
    public function move(
        array|FileMoveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FileRenameParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileRenameResponse>
     *
     * @throws APIException
     */
    public function rename(
        array|FileRenameParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FileUploadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileUploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        array|FileUploadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
