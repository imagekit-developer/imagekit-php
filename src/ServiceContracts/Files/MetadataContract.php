<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Files;

use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\Metadata;
use Imagekit\Files\Metadata\MetadataGetFromURLParams;
use Imagekit\RequestOptions;

interface MetadataContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): Metadata;

    /**
     * @api
     *
     * @param array<mixed>|MetadataGetFromURLParams $params
     *
     * @throws APIException
     */
    public function getFromURL(
        array|MetadataGetFromURLParams $params,
        ?RequestOptions $requestOptions = null,
    ): Metadata;
}
