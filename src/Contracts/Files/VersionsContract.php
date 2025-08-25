<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Files;

use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Versions\VersionDeleteResponse;
use ImageKit\Shared\File;

interface VersionsContract
{
    /**
     * @return list<File>
     */
    public function list(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @param string $fileID
     */
    public function delete(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): VersionDeleteResponse;

    /**
     * @param string $fileID
     */
    public function get(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): File;

    /**
     * @param string $fileID
     */
    public function restore(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): File;
}
