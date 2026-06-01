<?php

declare(strict_types=1);

namespace ImageKit\Services\Assets;

use ImageKit\Assets\FileDetails;
use ImageKit\Assets\FileVersionDetails;
use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Util;
use ImageKit\Cursor;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Assets\VersionsContract;

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
     * Returns details of all versions of a file.
     *
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param string $cursor Opaque cursor returned in the `start_cursor` or `end_cursor` field of a previous response. Pass it to fetch the next (or previous) page of results. Omit to start from the beginning.
     * @param int $limit the maximum number of results to return in response
     * @param RequestOpts|null $requestOptions
     *
     * @return Cursor<FileVersionDetails>
     *
     * @throws APIException
     */
    public function list(
        string $assetID,
        ?string $cursor = null,
        int $limit = 1000,
        RequestOptions|array|null $requestOptions = null,
    ): Cursor {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($assetID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deletes a non-current file version permanently. The API returns an empty response.
     *
     * Note: If you want to delete all versions of a file, use the delete asset API.
     *
     * @param string $versionID Unique identifier of the file version. Returned by the list and search assets API and the upload API.
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $versionID,
        string $assetID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['assetID' => $assetID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($versionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns details of a single version of a file.
     *
     * @param string $versionID Unique identifier of the file version. Returned by the list and search assets API and the upload API.
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $versionID,
        string $assetID,
        RequestOptions|array|null $requestOptions = null,
    ): FileVersionDetails {
        $params = Util::removeNulls(['assetID' => $assetID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get($versionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Restores a file version as the current file version.
     *
     * @param string $versionID Unique identifier of the file version. Returned by the list and search assets API and the upload API.
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function restore(
        string $versionID,
        string $assetID,
        RequestOptions|array|null $requestOptions = null,
    ): FileDetails {
        $params = Util::removeNulls(['assetID' => $assetID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->restore($versionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
