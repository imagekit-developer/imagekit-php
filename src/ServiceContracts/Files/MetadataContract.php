<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Files;

use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\Metadata;
use Imagekit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
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
