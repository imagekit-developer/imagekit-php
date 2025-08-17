<?php

declare(strict_types=1);

namespace ImageKit\Contracts;

use ImageKit\Assets\AssetListParams;
use ImageKit\Assets\AssetListParams\FileType;
use ImageKit\Assets\AssetListParams\Sort;
use ImageKit\Assets\AssetListParams\Type;
use ImageKit\RequestOptions;
use ImageKit\Responses\Assets\AssetListResponseItem\FileDetails;
use ImageKit\Responses\Assets\AssetListResponseItem\FolderDetails;

interface AssetsContract
{
    /**
     * @param array{
     *   fileType?: FileType::*,
     *   limit?: int,
     *   path?: string,
     *   searchQuery?: string,
     *   skip?: int,
     *   sort?: Sort::*,
     *   type?: Type::*,
     * }|AssetListParams $params
     *
     * @return list<FileDetails|FolderDetails>
     */
    public function list(
        array|AssetListParams $params,
        ?RequestOptions $requestOptions = null
    ): array;
}
