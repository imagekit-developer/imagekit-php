<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Beta\V2;

use Imagekit\Beta\V2\Files\FileUploadParams;
use Imagekit\Beta\V2\Files\FileUploadResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;

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
