<?php

declare(strict_types=1);

namespace ImageKit\Core\ServiceContracts\Files;

use ImageKit\Files\File;
use ImageKit\Files\Versions\VersionDeleteResponse;
use ImageKit\RequestOptions;

interface VersionsContract
{
    /**
     * @api
     *
     * @return list<File>
     */
    public function list(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param string $fileID
     */
    public function delete(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): VersionDeleteResponse;

    /**
     * @api
     *
     * @param string $fileID
     */
    public function get(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): File;

    /**
     * @api
     *
     * @param string $fileID
     */
    public function restore(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): File;
}
