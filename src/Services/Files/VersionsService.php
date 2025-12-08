<?php

declare(strict_types=1);

namespace Imagekit\Services\Files;

use Imagekit\Client;
use Imagekit\Core\Conversion\ListOf;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\Versions\VersionDeleteParams;
use Imagekit\Files\Versions\VersionDeleteResponse;
use Imagekit\Files\Versions\VersionGetParams;
use Imagekit\Files\Versions\VersionRestoreParams;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Files\VersionsContract;

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
        // @phpstan-ignore-next-line return.type
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
     * @param array{fileId: string}|VersionDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        string $versionID,
        array|VersionDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): VersionDeleteResponse {
        [$parsed, $options] = VersionDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $fileID = $parsed['fileId'];
        unset($parsed['fileId']);

        // @phpstan-ignore-next-line return.type
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
     * @param array{fileId: string}|VersionGetParams $params
     *
     * @throws APIException
     */
    public function get(
        string $versionID,
        array|VersionGetParams $params,
        ?RequestOptions $requestOptions = null,
    ): File {
        [$parsed, $options] = VersionGetParams::parseRequest(
            $params,
            $requestOptions,
        );
        $fileID = $parsed['fileId'];
        unset($parsed['fileId']);

        // @phpstan-ignore-next-line return.type
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
     * @param array{fileId: string}|VersionRestoreParams $params
     *
     * @throws APIException
     */
    public function restore(
        string $versionID,
        array|VersionRestoreParams $params,
        ?RequestOptions $requestOptions = null,
    ): File {
        [$parsed, $options] = VersionRestoreParams::parseRequest(
            $params,
            $requestOptions,
        );
        $fileID = $parsed['fileId'];
        unset($parsed['fileId']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['v1/files/%1$s/versions/%2$s/restore', $fileID, $versionID],
            options: $options,
            convert: File::class,
        );
    }
}
