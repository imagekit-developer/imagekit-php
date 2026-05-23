<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Files;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\Files\Metadata;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface MetadataContract
{
    /**
     * @api
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in the list and search assets API and upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): Metadata;

    /**
     * @api
     *
     * @param string $url Should be a valid file URL. It should be accessible using your ImageKit.io account.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getFromURL(
        string $url,
        RequestOptions|array|null $requestOptions = null
    ): Metadata;
}
