<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Files;

use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\Versions\VersionDeleteParams;
use Imagekit\Files\Versions\VersionDeleteResponse;
use Imagekit\Files\Versions\VersionGetParams;
use Imagekit\Files\Versions\VersionRestoreParams;
use Imagekit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
interface VersionsRawContract
{
    /**
     * @api
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<File>>
     *
     * @throws APIException
     */
    public function list(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param array<string,mixed>|VersionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VersionDeleteResponse>
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
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param array<string,mixed>|VersionGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<File>
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
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param array<string,mixed>|VersionRestoreParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<File>
     *
     * @throws APIException
     */
    public function restore(
        string $versionID,
        array|VersionRestoreParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
