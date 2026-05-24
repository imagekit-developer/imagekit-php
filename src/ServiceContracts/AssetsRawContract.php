<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts;

use ImageKit\Assets\AssetListParams;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Files\File;
use ImageKit\Files\Folder;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
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
