<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Files;

use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Versions\VersionDeleteResponse;
use ImageKit\Responses\Files\Versions\VersionGetResponse;
use ImageKit\Responses\Files\Versions\VersionListResponseItem;
use ImageKit\Responses\Files\Versions\VersionRestoreResponse;

interface VersionsContract
{
    /**
     * @return list<VersionListResponseItem>
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
    ): VersionGetResponse;

    /**
     * @param string $fileID
     */
    public function restore(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): VersionRestoreResponse;
}
