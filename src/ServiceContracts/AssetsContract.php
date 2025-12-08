<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

use Imagekit\Assets\AssetListParams;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\Folder;
use Imagekit\RequestOptions;

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
