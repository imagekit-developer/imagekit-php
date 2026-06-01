<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts;

use ImageKit\Assets\AssetCopyParams;
use ImageKit\Assets\AssetCopyResponse;
use ImageKit\Assets\AssetListParams;
use ImageKit\Assets\AssetListResponse;
use ImageKit\Assets\AssetMoveParams;
use ImageKit\Assets\AssetMoveResponse;
use ImageKit\Assets\AssetRenameParams;
use ImageKit\Assets\AssetRenameResponse;
use ImageKit\Assets\AssetUpdateParams;
use ImageKit\Assets\AssetUpdateResponse;
use ImageKit\Assets\AssetUploadParams;
use ImageKit\Assets\FileDetails;
use ImageKit\Assets\FolderDetails;
use ImageKit\Assets\UploadResponse;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface AssetsRawContract
{
    /**
     * @api
     *
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param array<string,mixed>|AssetUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $assetID,
        array|AssetUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AssetListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AssetListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AssetCopyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetCopyResponse>
     *
     * @throws APIException
     */
    public function copy(
        array|AssetCopyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $assetID Unique identifier of the asset. Can be a `file` or `folder` id as returned by the list and search assets or upload APIs.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileDetails|FolderDetails>
     *
     * @throws APIException
     */
    public function get(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AssetMoveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetMoveResponse>
     *
     * @throws APIException
     */
    public function move(
        array|AssetMoveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AssetRenameParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetRenameResponse>
     *
     * @throws APIException
     */
    public function rename(
        array|AssetRenameParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AssetUploadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        array|AssetUploadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
