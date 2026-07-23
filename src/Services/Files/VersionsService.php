<?php

declare(strict_types=1);

namespace ImageKit\Services\Files;

use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Util;
use ImageKit\Files\File;
use ImageKit\Files\Versions\VersionDeleteResponse;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Files\VersionsContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class VersionsService implements VersionsContract
{
    /**
     * @api
     */
    public VersionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new VersionsRawService($client);
    }

    /**
     * @api
     *
     * This API returns details of all versions of a file.
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @return list<File>
     *
     * @throws APIException
     */
    public function list(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($fileID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API deletes a non-current file version permanently. The API returns an empty response.
     *
     * Note: If you want to delete all versions of a file, use the delete file API.
     *
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $versionID,
        string $fileID,
        RequestOptions|array|null $requestOptions = null,
    ): VersionDeleteResponse {
        $params = Util::removeNulls(['fileID' => $fileID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($versionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API returns an object with details or attributes of a file version.
     *
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $versionID,
        string $fileID,
        RequestOptions|array|null $requestOptions = null,
    ): File {
        $params = Util::removeNulls(['fileID' => $fileID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get($versionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API restores a file version as the current file version.
     *
     * @param string $versionID The unique `versionId` of the uploaded file. `versionId` is returned in list and search assets API and upload API.
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in list and search assets API and upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function restore(
        string $versionID,
        string $fileID,
        RequestOptions|array|null $requestOptions = null,
    ): File {
        $params = Util::removeNulls(['fileID' => $fileID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->restore($versionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
