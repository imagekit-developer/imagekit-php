<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Assets\AssetListParams\FileType;
use ImageKit\Assets\AssetListParams\Sort;
use ImageKit\Assets\AssetListParams\Type;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API can list all the uploaded files and folders in your ImageKit.io media library. In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
 *
 * @phpstan-type asset_list_params = array{
 *   fileType?: FileType::*,
 *   limit?: int,
 *   path?: string,
 *   searchQuery?: string,
 *   skip?: int,
 *   sort?: Sort::*,
 *   type?: Type::*,
 * }
 */
final class AssetListParams implements BaseModel
{
    /** @use SdkModel<asset_list_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter results by file type.
     *
     * - `all` — include all file types
     * - `image` — include only image files
     * - `non-image` — include only non-image files (e.g., JS, CSS, video)
     *
     * @var FileType::*|null $fileType
     */
    #[Api(enum: FileType::class, optional: true)]
    public ?string $fileType;

    /**
     * The maximum number of results to return in response.
     */
    #[Api(optional: true)]
    public ?int $limit;

    /**
     * Folder path if you want to limit the search within a specific folder. For example, `/sales-banner/` will only search in folder sales-banner.
     *
     * Note : If your use case involves searching within a folder as well as its subfolders, you can use `path` parameter in `searchQuery` with appropriate operator.
     * Checkout [Supported parameters](/docs/api-reference/digital-asset-management-dam/list-and-search-assets#supported-parameters) for more information.
     */
    #[Api(optional: true)]
    public ?string $path;

    /**
     * Query string in a Lucene-like query language e.g. `createdAt > "7d"`.
     *
     * Note : When the searchQuery parameter is present, the following query parameters will have no effect on the result:
     *
     * 1. `tags`
     * 2. `type`
     * 3. `name`
     *
     * [Learn more](/docs/api-reference/digital-asset-management-dam/list-and-search-assets#advanced-search-queries) from examples.
     */
    #[Api(optional: true)]
    public ?string $searchQuery;

    /**
     * The number of results to skip before returning results.
     */
    #[Api(optional: true)]
    public ?int $skip;

    /**
     * Sort the results by one of the supported fields in ascending or descending order.
     *
     * @var Sort::*|null $sort
     */
    #[Api(enum: Sort::class, optional: true)]
    public ?string $sort;

    /**
     * Filter results by asset type.
     *
     * - `file` — returns only files
     * - `file-version` — returns specific file versions
     * - `folder` — returns only folders
     * - `all` — returns both files and folders (excludes `file-version`)
     *
     * @var Type::*|null $type
     */
    #[Api(enum: Type::class, optional: true)]
    public ?string $type;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param FileType::* $fileType
     * @param Sort::* $sort
     * @param Type::* $type
     */
    public static function with(
        ?string $fileType = null,
        ?int $limit = null,
        ?string $path = null,
        ?string $searchQuery = null,
        ?int $skip = null,
        ?string $sort = null,
        ?string $type = null,
    ): self {
        $obj = new self;

        null !== $fileType && $obj->fileType = $fileType;
        null !== $limit && $obj->limit = $limit;
        null !== $path && $obj->path = $path;
        null !== $searchQuery && $obj->searchQuery = $searchQuery;
        null !== $skip && $obj->skip = $skip;
        null !== $sort && $obj->sort = $sort;
        null !== $type && $obj->type = $type;

        return $obj;
    }

    /**
     * Filter results by file type.
     *
     * - `all` — include all file types
     * - `image` — include only image files
     * - `non-image` — include only non-image files (e.g., JS, CSS, video)
     *
     * @param FileType::* $fileType
     */
    public function withFileType(string $fileType): self
    {
        $obj = clone $this;
        $obj->fileType = $fileType;

        return $obj;
    }

    /**
     * The maximum number of results to return in response.
     */
    public function withLimit(int $limit): self
    {
        $obj = clone $this;
        $obj->limit = $limit;

        return $obj;
    }

    /**
     * Folder path if you want to limit the search within a specific folder. For example, `/sales-banner/` will only search in folder sales-banner.
     *
     * Note : If your use case involves searching within a folder as well as its subfolders, you can use `path` parameter in `searchQuery` with appropriate operator.
     * Checkout [Supported parameters](/docs/api-reference/digital-asset-management-dam/list-and-search-assets#supported-parameters) for more information.
     */
    public function withPath(string $path): self
    {
        $obj = clone $this;
        $obj->path = $path;

        return $obj;
    }

    /**
     * Query string in a Lucene-like query language e.g. `createdAt > "7d"`.
     *
     * Note : When the searchQuery parameter is present, the following query parameters will have no effect on the result:
     *
     * 1. `tags`
     * 2. `type`
     * 3. `name`
     *
     * [Learn more](/docs/api-reference/digital-asset-management-dam/list-and-search-assets#advanced-search-queries) from examples.
     */
    public function withSearchQuery(string $searchQuery): self
    {
        $obj = clone $this;
        $obj->searchQuery = $searchQuery;

        return $obj;
    }

    /**
     * The number of results to skip before returning results.
     */
    public function withSkip(int $skip): self
    {
        $obj = clone $this;
        $obj->skip = $skip;

        return $obj;
    }

    /**
     * Sort the results by one of the supported fields in ascending or descending order.
     *
     * @param Sort::* $sort
     */
    public function withSort(string $sort): self
    {
        $obj = clone $this;
        $obj->sort = $sort;

        return $obj;
    }

    /**
     * Filter results by asset type.
     *
     * - `file` — returns only files
     * - `file-version` — returns specific file versions
     * - `folder` — returns only folders
     * - `all` — returns both files and folders (excludes `file-version`)
     *
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }
}
