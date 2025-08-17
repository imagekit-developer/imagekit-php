<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Files;

use ImageKit\Files\Metadata\MetadataGetFromURLParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Metadata\MetadataGetFromURLResponse;
use ImageKit\Responses\Files\Metadata\MetadataGetResponse;

interface MetadataContract
{
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): MetadataGetResponse;

    /**
     * @param array{url: string}|MetadataGetFromURLParams $params
     */
    public function getFromURL(
        array|MetadataGetFromURLParams $params,
        ?RequestOptions $requestOptions = null,
    ): MetadataGetFromURLResponse;
}
