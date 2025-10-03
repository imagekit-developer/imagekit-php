<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Files;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\Files\File;
use ImageKit\Files\Versions\VersionDeleteResponse;
use ImageKit\RequestOptions;

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
     * @param string $fileID
     *
     * @throws APIException
     */
    public function delete(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): VersionDeleteResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $versionID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): VersionDeleteResponse;

    /**
     * @api
     *
     * @param string $fileID
     *
     * @throws APIException
     */
    public function get(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): File;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function getRaw(
        string $versionID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): File;

    /**
     * @api
     *
     * @param string $fileID
     *
     * @throws APIException
     */
    public function restore(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): File;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function restoreRaw(
        string $versionID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): File;
}
