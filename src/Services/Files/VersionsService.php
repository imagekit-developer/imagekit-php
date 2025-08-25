<?php

declare(strict_types=1);

namespace ImageKit\Services\Files;

use ImageKit\Client;
use ImageKit\Contracts\Files\VersionsContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Files\Versions\VersionDeleteParams;
use ImageKit\Files\Versions\VersionGetParams;
use ImageKit\Files\Versions\VersionRestoreParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Versions\VersionDeleteResponse;
use ImageKit\Shared\File;

final class VersionsService implements VersionsContract
{
    public function __construct(private Client $client) {}

    /**
     * This API returns details of all versions of a file.
     *
     * @return list<File>
     */
    public function list(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): array {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/files/%1$s/versions', $fileID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(new ListOf(File::class), value: $resp);
    }

    /**
     * This API deletes a non-current file version permanently. The API returns an empty response.
     *
     * Note: If you want to delete all versions of a file, use the delete file API.
     *
     * @param string $fileID
     */
    public function delete(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): VersionDeleteResponse {
        $args = ['fileID' => $fileID];
        [$parsed, $options] = VersionDeleteParams::parseRequest(
            $args,
            $requestOptions
        );
        $fileID = $parsed['fileID'];
        unset($parsed['fileID']);
        $resp = $this->client->request(
            method: 'delete',
            path: ['v1/files/%1$s/versions/%2$s', $fileID, $versionID],
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(VersionDeleteResponse::class, value: $resp);
    }

    /**
     * This API returns an object with details or attributes of a file version.
     *
     * @param string $fileID
     */
    public function get(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): File {
        $args = ['fileID' => $fileID];
        [$parsed, $options] = VersionGetParams::parseRequest(
            $args,
            $requestOptions
        );
        $fileID = $parsed['fileID'];
        unset($parsed['fileID']);
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/files/%1$s/versions/%2$s', $fileID, $versionID],
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(File::class, value: $resp);
    }

    /**
     * This API restores a file version as the current file version.
     *
     * @param string $fileID
     */
    public function restore(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): File {
        $args = ['fileID' => $fileID];
        [$parsed, $options] = VersionRestoreParams::parseRequest(
            $args,
            $requestOptions
        );
        $fileID = $parsed['fileID'];
        unset($parsed['fileID']);
        $resp = $this->client->request(
            method: 'put',
            path: ['v1/files/%1$s/versions/%2$s/restore', $fileID, $versionID],
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(File::class, value: $resp);
    }
}
