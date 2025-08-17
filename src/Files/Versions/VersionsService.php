<?php

declare(strict_types=1);

namespace ImageKit\Files\Versions;

use ImageKit\Client;
use ImageKit\Contracts\Files\VersionsContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Versions\VersionDeleteResponse;
use ImageKit\Responses\Files\Versions\VersionGetResponse;
use ImageKit\Responses\Files\Versions\VersionListResponseItem;
use ImageKit\Responses\Files\Versions\VersionRestoreResponse;

final class VersionsService implements VersionsContract
{
    public function __construct(private Client $client) {}

    /**
     * This API returns details of all versions of a file.
     *
     * @return list<VersionListResponseItem>
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
        return Conversion::coerce(
            new ListOf(VersionListResponseItem::class),
            value: $resp
        );
    }

    /**
     * This API deletes a non-current file version permanently. The API returns an empty response.
     *
     * Note: If you want to delete all versions of a file, use the delete file API.
     *
     * @param array{fileID: string}|VersionDeleteParams $params
     */
    public function delete(
        string $versionID,
        array|VersionDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): VersionDeleteResponse {
        [$parsed, $options] = VersionDeleteParams::parseRequest(
            $params,
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
     * @param array{fileID: string}|VersionGetParams $params
     */
    public function get(
        string $versionID,
        array|VersionGetParams $params,
        ?RequestOptions $requestOptions = null,
    ): VersionGetResponse {
        [$parsed, $options] = VersionGetParams::parseRequest(
            $params,
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
        return Conversion::coerce(VersionGetResponse::class, value: $resp);
    }

    /**
     * This API restores a file version as the current file version.
     *
     * @param array{fileID: string}|VersionRestoreParams $params
     */
    public function restore(
        string $versionID,
        array|VersionRestoreParams $params,
        ?RequestOptions $requestOptions = null,
    ): VersionRestoreResponse {
        [$parsed, $options] = VersionRestoreParams::parseRequest(
            $params,
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
        return Conversion::coerce(VersionRestoreResponse::class, value: $resp);
    }
}
