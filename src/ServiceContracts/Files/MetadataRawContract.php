<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Files;

use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\Metadata;
use Imagekit\Files\Metadata\MetadataGetFromURLParams;
use Imagekit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
interface MetadataRawContract
{
    /**
     * @api
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in the list and search assets API and upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Metadata>
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MetadataGetFromURLParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Metadata>
     *
     * @throws APIException
     */
    public function getFromURL(
        array|MetadataGetFromURLParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
