<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Files;

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
     * @param string $url Should be a valid file URL. It should be accessible using your ImageKit.io account.
     */
    public function getFromURL(
        $url,
        ?RequestOptions $requestOptions = null
    ): MetadataGetFromURLResponse;
}
