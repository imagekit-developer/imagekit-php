<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Assets\AssetListParams\FileType;
use ImageKit\Assets\AssetListParams\Sort;
use ImageKit\Assets\AssetListParams\Type;
use ImageKit\Client;
use ImageKit\Contracts\AssetsContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\RequestOptions;
use ImageKit\Responses\Assets\AssetListResponseItem;
use ImageKit\Responses\Assets\AssetListResponseItem\FileDetails;
use ImageKit\Responses\Assets\AssetListResponseItem\FolderDetails;

final class AssetsService implements AssetsContract
{
    public function __construct(private Client $client) {}

    /**
     * This API can list all the uploaded files and folders in your ImageKit.io media library. In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
     *
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
     * @return list<FileDetails|FolderDetails>
     */
    public function list(
        $fileType = null,
        $limit = null,
        $path = null,
        $searchQuery = null,
        $skip = null,
        $sort = null,
        $type = null,
        ?RequestOptions $requestOptions = null,
    ): array {
        [$parsed, $options] = AssetListParams::parseRequest(
            [
                'fileType' => $fileType,
                'limit' => $limit,
                'path' => $path,
                'searchQuery' => $searchQuery,
                'skip' => $skip,
                'sort' => $sort,
                'type' => $type,
            ],
            $requestOptions,
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'v1/files',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            new ListOf(AssetListResponseItem::class),
            value: $resp
        );
    }
}
