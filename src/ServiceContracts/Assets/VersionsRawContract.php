<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Assets;

use ImageKit\Assets\FileDetails;
use ImageKit\Assets\FileVersionDetails;
use ImageKit\Assets\Versions\VersionDeleteParams;
use ImageKit\Assets\Versions\VersionGetParams;
use ImageKit\Assets\Versions\VersionListParams;
use ImageKit\Assets\Versions\VersionListResponse;
use ImageKit\Assets\Versions\VersionRestoreParams;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface VersionsRawContract
{
    /**
     * @api
     *
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param array<string,mixed>|VersionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VersionListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $assetID,
        array|VersionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $versionID Unique identifier of the file version. Returned by the list and search assets API and the upload API.
     * @param array<string,mixed>|VersionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $versionID,
        array|VersionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $versionID Unique identifier of the file version. Returned by the list and search assets API and the upload API.
     * @param array<string,mixed>|VersionGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileVersionDetails>
     *
     * @throws APIException
     */
    public function get(
        string $versionID,
        array|VersionGetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $versionID Unique identifier of the file version. Returned by the list and search assets API and the upload API.
     * @param array<string,mixed>|VersionRestoreParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileDetails>
     *
     * @throws APIException
     */
    public function restore(
        string $versionID,
        array|VersionRestoreParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
