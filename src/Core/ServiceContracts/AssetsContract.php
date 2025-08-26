<?php

declare(strict_types=1);

namespace ImageKit\Core\ServiceContracts;

use ImageKit\Assets\AssetListParams\FileType;
use ImageKit\Assets\AssetListParams\Sort;
use ImageKit\Assets\AssetListParams\Type;
use ImageKit\Files\File;
use ImageKit\Files\Folder;
use ImageKit\RequestOptions;

use const ImageKit\Core\OMIT as omit;

interface AssetsContract
{
    /**
     * @param FileType::* $fileType Filter results by file type.
     *
     * - `all` — include all file types
     * - `image` — include only image files
     * - `non-image` — include only non-image files (e.g., JS, CSS, video)
     * @param int $limit the maximum number of results to return in response
     * @param string $path Folder path if you want to limit the search within a specific folder. For example, `/sales-banner/` will only search in folder sales-banner.
     *
     * Note : If your use case involves searching within a folder as well as its subfolders, you can use `path` parameter in `searchQuery` with appropriate operator.
     * Checkout [Supported parameters](/docs/api-reference/digital-asset-management-dam/list-and-search-assets#supported-parameters) for more information.
     * @param string $searchQuery Query string in a Lucene-like query language e.g. `createdAt > "7d"`.
     *
     * Note : When the searchQuery parameter is present, the following query parameters will have no effect on the result:
     *
     * 1. `tags`
     * 2. `type`
     * 3. `name`
     *
     * [Learn more](/docs/api-reference/digital-asset-management-dam/list-and-search-assets#advanced-search-queries) from examples.
     * @param int $skip the number of results to skip before returning results
     * @param Sort::* $sort sort the results by one of the supported fields in ascending or descending order
     * @param Type::* $type Filter results by asset type.
     *
     * - `file` — returns only files
     * - `file-version` — returns specific file versions
     * - `folder` — returns only folders
     * - `all` — returns both files and folders (excludes `file-version`)
     *
     * @return list<File|Folder>
     */
    public function list(
        $fileType = omit,
        $limit = omit,
        $path = omit,
        $searchQuery = omit,
        $skip = omit,
        $sort = omit,
        $type = omit,
        ?RequestOptions $requestOptions = null,
    ): array;
}
