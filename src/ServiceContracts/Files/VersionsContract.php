<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Files;

use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\Versions\VersionDeleteResponse;
use Imagekit\RequestOptions;

interface VersionsContract
{
    /**
     * @api
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     *
     * @return list<File>
     *
     * @throws APIException
     */
    public function list(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     *
     * @throws APIException
     */
    public function delete(
        string $versionID,
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): VersionDeleteResponse;

    /**
     * @api
     *
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     *
     * @throws APIException
     */
    public function get(
        string $versionID,
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): File;

    /**
     * @api
     *
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     *
     * @throws APIException
     */
    public function restore(
        string $versionID,
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): File;
}
