<?php

declare(strict_types=1);

namespace ImageKit\Core\ServiceContracts\Files;

use ImageKit\Files\Metadata;
use ImageKit\RequestOptions;

interface MetadataContract
{
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): Metadata;

    /**
     * @param string $url Should be a valid file URL. It should be accessible using your ImageKit.io account.
     */
    public function getFromURL(
        $url,
        ?RequestOptions $requestOptions = null
    ): Metadata;
}
