<?php

declare(strict_types=1);

namespace ImageKit\Services\Assets;

use ImageKit\Assets\FileDetails;
use ImageKit\Assets\FileVersionDetails;
use ImageKit\Assets\Versions\VersionDeleteParams;
use ImageKit\Assets\Versions\VersionGetParams;
use ImageKit\Assets\Versions\VersionListParams;
use ImageKit\Assets\Versions\VersionListResponse;
use ImageKit\Assets\Versions\VersionRestoreParams;
use ImageKit\Client;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Assets\VersionsRawContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
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
     * Returns details of all versions of a file.
     *
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param array{cursor?: string, limit?: int}|VersionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VersionListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $assetID,
        array|VersionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VersionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v2/assets/%1$s/versions', $assetID],
            query: $parsed,
            options: $options,
            convert: VersionListResponse::class,
        );
    }

    /**
     * @api
     *
     * Deletes a non-current file version permanently. The API returns an empty response.
     *
     * Note: If you want to delete all versions of a file, use the delete asset API.
     *
     * @param string $versionID Unique identifier of the file version. Returned by the list and search assets API and the upload API.
     * @param array{assetID: string}|VersionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
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
        $assetID = $parsed['assetID'];
        unset($parsed['assetID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v2/assets/%1$s/versions/%2$s', $assetID, $versionID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns details of a single version of a file.
     *
     * @param string $versionID Unique identifier of the file version. Returned by the list and search assets API and the upload API.
     * @param array{assetID: string}|VersionGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileVersionDetails>
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
        $assetID = $parsed['assetID'];
        unset($parsed['assetID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v2/assets/%1$s/versions/%2$s', $assetID, $versionID],
            options: $options,
            convert: FileVersionDetails::class,
        );
    }

    /**
     * @api
     *
     * Restores a file version as the current file version.
     *
     * @param string $versionID Unique identifier of the file version. Returned by the list and search assets API and the upload API.
     * @param array{assetID: string}|VersionRestoreParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileDetails>
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
        $assetID = $parsed['assetID'];
        unset($parsed['assetID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v2/assets/%1$s/versions/%2$s/restore', $assetID, $versionID],
            options: $options,
            convert: FileDetails::class,
        );
    }
}
