<?php

declare(strict_types=1);

namespace Imagekit\Services\Files;

use Imagekit\Client;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Conversion\ListOf;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\Versions\VersionDeleteParams;
use Imagekit\Files\Versions\VersionDeleteResponse;
use Imagekit\Files\Versions\VersionGetParams;
use Imagekit\Files\Versions\VersionRestoreParams;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Files\VersionsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
final class VersionsRawService implements VersionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This API returns details of all versions of a file.
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<File>>
     *
     * @throws APIException
     */
    public function list(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
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
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param array{fileID: string}|VersionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VersionDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $versionID,
        array|VersionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VersionDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $fileID = $parsed['fileID'];
        unset($parsed['fileID']);

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
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param array{fileID: string}|VersionGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<File>
     *
     * @throws APIException
     */
    public function get(
        string $versionID,
        array|VersionGetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VersionGetParams::parseRequest(
            $params,
            $requestOptions,
        );
        $fileID = $parsed['fileID'];
        unset($parsed['fileID']);

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
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param array{fileID: string}|VersionRestoreParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<File>
     *
     * @throws APIException
     */
    public function restore(
        string $versionID,
        array|VersionRestoreParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VersionRestoreParams::parseRequest(
            $params,
            $requestOptions,
        );
        $fileID = $parsed['fileID'];
        unset($parsed['fileID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['v1/files/%1$s/versions/%2$s/restore', $fileID, $versionID],
            options: $options,
            convert: File::class,
        );
    }
}
