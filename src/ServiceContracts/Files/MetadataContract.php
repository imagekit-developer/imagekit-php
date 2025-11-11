<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Files;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\Files\Metadata;
use ImageKit\Files\Metadata\MetadataGetFromURLParams;
use ImageKit\RequestOptions;

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
