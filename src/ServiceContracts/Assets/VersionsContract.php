<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Assets;

use ImageKit\Assets\FileDetails;
use ImageKit\Assets\FileVersionDetails;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Cursor;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface VersionsContract
{
    /**
     * @api
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
    ): Cursor;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): FileVersionDetails;

    /**
     * @api
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
    ): FileDetails;
}
