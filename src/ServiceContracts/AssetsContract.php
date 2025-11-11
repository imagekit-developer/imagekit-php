<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts;

use ImageKit\Assets\AssetListParams;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Files\File;
use ImageKit\Files\Folder;
use ImageKit\RequestOptions;

interface AssetsContract
{
    /**
     * @api
     *
     * @param array<mixed>|AssetListParams $params
     *
     * @return list<File|Folder>
     *
     * @throws APIException
     */
    public function list(
        array|AssetListParams $params,
        ?RequestOptions $requestOptions = null
    ): array;
}
