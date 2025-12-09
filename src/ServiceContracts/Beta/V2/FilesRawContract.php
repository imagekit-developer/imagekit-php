<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Beta\V2;

use Imagekit\Beta\V2\Files\FileUploadParams;
use Imagekit\Beta\V2\Files\FileUploadResponse;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;

interface FilesRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|FileUploadParams $params
     *
     * @return BaseResponse<FileUploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        array|FileUploadParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
