<?php

declare(strict_types=1);

namespace Imagekit\Assets;

use Imagekit\Assets\AssetListParams\FileType;
use Imagekit\Assets\AssetListParams\Sort;
use Imagekit\Assets\AssetListParams\Type;
use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This API can list all the uploaded files and folders in your ImageKit.io media library. In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
 *
 * @see Imagekit\Services\AssetsService::list()
 *
 * @phpstan-type AssetListParamsShape = array{
 *   fileType?: null|FileType|value-of<FileType>,
 *   limit?: int|null,
 *   path?: string|null,
 *   searchQuery?: string|null,
 *   skip?: int|null,
 *   sort?: null|Sort|value-of<Sort>,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class AssetListParams implements BaseModel
{
    /** @use SdkModel<AssetListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter results by file type.
     *
     * - `all` — include all file types
     * - `image` — include only image files
     * - `non-image` — include only non-image files (e.g., JS, CSS, video)
     *
     * @var value-of<FileType>|null $fileType
     */
    #[Optional(enum: FileType::class)]
    public ?string $fileType;

    /**
     * The maximum number of results to return in response.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Folder path if you want to limit the search within a specific folder. For example, `/sales-banner/` will only search in folder sales-banner.
     *
     * Note : If your use case involves searching within a folder as well as its subfolders, you can use `path` parameter in `searchQuery` with appropriate operator.
     * Checkout [Supported parameters](/docs/api-reference/digital-asset-management-dam/list-and-search-assets#supported-parameters) for more information.
     */
    #[Optional]
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
    #[Optional]
    public ?string $searchQuery;

    /**
     * The number of results to skip before returning results.
     */
    #[Optional]
    public ?int $skip;

    /**
     * Sort the results by one of the supported fields in ascending or descending order.
     *
     * @var value-of<Sort>|null $sort
     */
    #[Optional(enum: Sort::class)]
    public ?string $sort;

    /**
     * Filter results by asset type.
     *
     * - `file` — returns only files
     * - `file-version` — returns specific file versions
     * - `folder` — returns only folders
     * - `all` — returns both files and folders (excludes `file-version`)
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param FileType|value-of<FileType>|null $fileType
     * @param Sort|value-of<Sort>|null $sort
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        FileType|string|null $fileType = null,
        ?int $limit = null,
        ?string $path = null,
        ?string $searchQuery = null,
        ?int $skip = null,
        Sort|string|null $sort = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $fileType && $self['fileType'] = $fileType;
        null !== $limit && $self['limit'] = $limit;
        null !== $path && $self['path'] = $path;
        null !== $searchQuery && $self['searchQuery'] = $searchQuery;
        null !== $skip && $self['skip'] = $skip;
        null !== $sort && $self['sort'] = $sort;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Filter results by file type.
     *
     * - `all` — include all file types
     * - `image` — include only image files
     * - `non-image` — include only non-image files (e.g., JS, CSS, video)
     *
     * @param FileType|value-of<FileType> $fileType
     */
    public function withFileType(FileType|string $fileType): self
    {
        $self = clone $this;
        $self['fileType'] = $fileType;

        return $self;
    }

    /**
     * The maximum number of results to return in response.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Folder path if you want to limit the search within a specific folder. For example, `/sales-banner/` will only search in folder sales-banner.
     *
     * Note : If your use case involves searching within a folder as well as its subfolders, you can use `path` parameter in `searchQuery` with appropriate operator.
     * Checkout [Supported parameters](/docs/api-reference/digital-asset-management-dam/list-and-search-assets#supported-parameters) for more information.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
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
        $self = clone $this;
        $self['searchQuery'] = $searchQuery;

        return $self;
    }

    /**
     * The number of results to skip before returning results.
     */
    public function withSkip(int $skip): self
    {
        $self = clone $this;
        $self['skip'] = $skip;

        return $self;
    }

    /**
     * Sort the results by one of the supported fields in ascending or descending order.
     *
     * @param Sort|value-of<Sort> $sort
     */
    public function withSort(Sort|string $sort): self
    {
        $self = clone $this;
        $self['sort'] = $sort;

        return $self;
    }

    /**
     * Filter results by asset type.
     *
     * - `file` — returns only files
     * - `file-version` — returns specific file versions
     * - `folder` — returns only folders
     * - `all` — returns both files and folders (excludes `file-version`)
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
