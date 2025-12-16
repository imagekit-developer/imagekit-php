<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Files;

use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\Metadata;
use Imagekit\Files\Metadata\MetadataGetFromURLParams;
use Imagekit\RequestOptions;

interface MetadataRawContract
{
    /**
     * @api
     *
     * @param string $fileID The unique `fileId` of the uploaded file. `fileId` is returned in the list and search assets API and upload API.
     *
     * @return BaseResponse<Metadata>
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MetadataGetFromURLParams $params
     *
     * @return BaseResponse<Metadata>
     *
     * @throws APIException
     */
    public function getFromURL(
        array|MetadataGetFromURLParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
