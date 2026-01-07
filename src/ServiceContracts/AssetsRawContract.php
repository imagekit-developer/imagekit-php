<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

use Imagekit\Assets\AssetListParams;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\Folder;
use Imagekit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
interface AssetsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AssetListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<File|Folder>>
     *
     * @throws APIException
     */
    public function list(
        array|AssetListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
