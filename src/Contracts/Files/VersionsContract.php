<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Files;

use ImageKit\Files\Versions\VersionDeleteParams;
use ImageKit\Files\Versions\VersionGetParams;
use ImageKit\Files\Versions\VersionRestoreParams;
use ImageKit\RequestOptions;
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
     * @param array{fileID: string}|VersionDeleteParams $params
     */
    public function delete(
        string $versionID,
        array|VersionDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @param array{fileID: string}|VersionGetParams $params
     */
    public function get(
        string $versionID,
        array|VersionGetParams $params,
        ?RequestOptions $requestOptions = null,
    ): VersionGetResponse;

    /**
     * @param array{fileID: string}|VersionRestoreParams $params
     */
    public function restore(
        string $versionID,
        array|VersionRestoreParams $params,
        ?RequestOptions $requestOptions = null,
    ): VersionRestoreResponse;
}
