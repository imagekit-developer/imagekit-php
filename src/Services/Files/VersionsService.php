<?php

declare(strict_types=1);

namespace ImageKit\Services\Files;

use ImageKit\Client;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Implementation\HasRawResponse;
use ImageKit\Files\File;
use ImageKit\Files\Versions\VersionDeleteParams;
use ImageKit\Files\Versions\VersionDeleteResponse;
use ImageKit\Files\Versions\VersionGetParams;
use ImageKit\Files\Versions\VersionRestoreParams;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Files\VersionsContract;

final class VersionsService implements VersionsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This API returns details of all versions of a file.
     *
     * @return list<File>
     *
     * @throws APIException
     */
    public function list(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): array {
        $params = [];

        return $this->listRaw($fileID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return list<File>
     *
     * @throws APIException
     */
    public function listRaw(
        string $fileID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['v1/files/%1$s/versions', $fileID],
            options: $requestOptions,
            convert: new ListOf(File::class),
        );
    }

    /**
     * @api
     *
     * This API deletes a non-current file version permanently. The API returns an empty response.
     *
     * Note: If you want to delete all versions of a file, use the delete file API.
     *
     * @param string $fileID
     *
     * @return VersionDeleteResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): VersionDeleteResponse {
        $params = ['fileID' => $fileID];

        return $this->deleteRaw($versionID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return VersionDeleteResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $versionID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): VersionDeleteResponse {
        [$parsed, $options] = VersionDeleteParams::parseRequest(
            $params,
            $requestOptions
        );
        $fileID = $parsed['fileID'];
        unset($parsed['fileID']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['v1/files/%1$s/versions/%2$s', $fileID, $versionID],
            options: $options,
            convert: VersionDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * This API returns an object with details or attributes of a file version.
     *
     * @param string $fileID
     *
     * @return File<HasRawResponse>
     *
     * @throws APIException
     */
    public function get(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): File {
        $params = ['fileID' => $fileID];

        return $this->getRaw($versionID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return File<HasRawResponse>
     *
     * @throws APIException
     */
    public function getRaw(
        string $versionID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): File {
        [$parsed, $options] = VersionGetParams::parseRequest(
            $params,
            $requestOptions
        );
        $fileID = $parsed['fileID'];
        unset($parsed['fileID']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['v1/files/%1$s/versions/%2$s', $fileID, $versionID],
            options: $options,
            convert: File::class,
        );
    }

    /**
     * @api
     *
     * This API restores a file version as the current file version.
     *
     * @param string $fileID
     *
     * @return File<HasRawResponse>
     *
     * @throws APIException
     */
    public function restore(
        string $versionID,
        $fileID,
        ?RequestOptions $requestOptions = null
    ): File {
        $params = ['fileID' => $fileID];

        return $this->restoreRaw($versionID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return File<HasRawResponse>
     *
     * @throws APIException
     */
    public function restoreRaw(
        string $versionID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): File {
        [$parsed, $options] = VersionRestoreParams::parseRequest(
            $params,
            $requestOptions
        );
        $fileID = $parsed['fileID'];
        unset($parsed['fileID']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['v1/files/%1$s/versions/%2$s/restore', $fileID, $versionID],
            options: $options,
            convert: File::class,
        );
    }
}
