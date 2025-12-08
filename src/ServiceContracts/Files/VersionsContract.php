<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Files;

use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\Versions\VersionDeleteParams;
use Imagekit\Files\Versions\VersionDeleteResponse;
use Imagekit\Files\Versions\VersionGetParams;
use Imagekit\Files\Versions\VersionRestoreParams;
use Imagekit\RequestOptions;

interface VersionsContract
{
    /**
     * @api
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
     * @param array<mixed>|VersionDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        string $versionID,
        array|VersionDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): VersionDeleteResponse;

    /**
     * @api
     *
     * @param array<mixed>|VersionGetParams $params
     *
     * @throws APIException
     */
    public function get(
        string $versionID,
        array|VersionGetParams $params,
        ?RequestOptions $requestOptions = null,
    ): File;

    /**
     * @api
     *
     * @param array<mixed>|VersionRestoreParams $params
     *
     * @throws APIException
     */
    public function restore(
        string $versionID,
        array|VersionRestoreParams $params,
        ?RequestOptions $requestOptions = null,
    ): File;
}
