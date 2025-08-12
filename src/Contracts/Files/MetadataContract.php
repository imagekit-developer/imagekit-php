<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Files;

use ImageKit\Files\Metadata\MetadataFromURLParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Metadata\MetadataFromURLResponse;
use ImageKit\Responses\Files\Metadata\MetadataGetResponse;

interface MetadataContract
{
    public function retrieve(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): MetadataGetResponse;

    /**
     * @param array{url: string}|MetadataFromURLParams $params
     */
    public function fromURL(
        array|MetadataFromURLParams $params,
        ?RequestOptions $requestOptions = null,
    ): MetadataFromURLResponse;
}
