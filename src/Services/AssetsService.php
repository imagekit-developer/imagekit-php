<?php

declare(strict_types=1);

namespace Imagekit\Services;

use Imagekit\Assets\AssetListParams\FileType;
use Imagekit\Assets\AssetListParams\Sort;
use Imagekit\Assets\AssetListParams\Type;
use Imagekit\Client;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\Folder;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\AssetsContract;

final class AssetsService implements AssetsContract
{
    /**
     * @api
     */
    public AssetsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AssetsRawService($client);
    }

    /**
     * @api
     *
     * This API can list all the uploaded files and folders in your ImageKit.io media library. In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
     *
     * @param 'all'|'image'|'non-image'|FileType $fileType Filter results by file type.
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
     * @param 'ASC_NAME'|'DESC_NAME'|'ASC_CREATED'|'DESC_CREATED'|'ASC_UPDATED'|'DESC_UPDATED'|'ASC_HEIGHT'|'DESC_HEIGHT'|'ASC_WIDTH'|'DESC_WIDTH'|'ASC_SIZE'|'DESC_SIZE'|'ASC_RELEVANCE'|'DESC_RELEVANCE'|Sort $sort sort the results by one of the supported fields in ascending or descending order
     * @param 'file'|'file-version'|'folder'|'all'|Type $type Filter results by asset type.
     *
     * - `file` — returns only files
     * - `file-version` — returns specific file versions
     * - `folder` — returns only folders
     * - `all` — returns both files and folders (excludes `file-version`)
     *
     * @return list<File|Folder>
     *
     * @throws APIException
     */
    public function list(
        string|FileType $fileType = 'all',
        int $limit = 1000,
        ?string $path = null,
        ?string $searchQuery = null,
        int $skip = 0,
        string|Sort $sort = 'ASC_CREATED',
        string|Type $type = 'file',
        ?RequestOptions $requestOptions = null,
    ): array {
        $params = [
            'fileType' => $fileType,
            'limit' => $limit,
            'path' => $path,
            'searchQuery' => $searchQuery,
            'skip' => $skip,
            'sort' => $sort,
            'type' => $type,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
