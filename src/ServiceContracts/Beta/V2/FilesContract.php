<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Beta\V2;

use ImageKit\Beta\V2\Files\FileUploadParams;
use ImageKit\Beta\V2\Files\FileUploadResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

interface FilesContract
{
    /**
     * @api
     *
     * @param array<mixed>|FileUploadParams $params
     *
     * @throws APIException
     */
    public function upload(
        array|FileUploadParams $params,
        ?RequestOptions $requestOptions = null
    ): FileUploadResponse;
}
