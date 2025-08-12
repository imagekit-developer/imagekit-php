<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\FileListParams\Type;

/**
 * This API can list all the uploaded files and folders in your ImageKit.io media library. In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
 *
 * @phpstan-type list_params = array{
 *   fileType?: string,
 *   limit?: string,
 *   path?: string,
 *   searchQuery?: string,
 *   skip?: string,
 *   sort?: string,
 *   type?: Type::*,
 * }
 */
final class FileListParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Type of files to include in the result set. Accepts three values:
     *
     * `all` - include all types of files in the result set.
     * `image` - only search in image type files.
     * `non-image` - only search in files that are not images, e.g., JS or CSS or video files.
     *
     * Default value - `all`
     */
    #[Api(optional: true)]
    public ?string $fileType;

    /**
     * The maximum number of results to return in response:
     *
     * Minimum value - 1
     *
     * Maximum value - 1000
     *
     * Default value - 1000
     */
    #[Api(optional: true)]
    public ?string $limit;

    /**
     * Folder path if you want to limit the search within a specific folder. For example, `/sales-banner/` will only search in folder sales-banner.
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
     * The number of results to skip before returning results:
     *
     * Minimum value - 0
     *
     * Default value - 0
     */
    #[Api(optional: true)]
    public ?string $skip;

    /**
     * You can sort based on the following fields:
     *
     * 1. name - `ASC_NAME` or `DESC_NAME`
     * 2. createdAt - `ASC_CREATED` or `DESC_CREATED`
     * 3. updatedAt - `ASC_UPDATED` or `DESC_UPDATED`
     * 4. height - `ASC_HEIGHT` or `DESC_HEIGHT`
     * 5. width - `ASC_WIDTH` or `DESC_WIDTH`
     * 6. size - `ASC_SIZE` or `DESC_SIZE`
     *
     * Default value - `ASC_CREATED`
     */
    #[Api(optional: true)]
    public ?string $sort;

    /**
     * Limit search to one of `file`, `file-version`, or `folder`. Pass `all` to include `files` and `folders` in search results (`file-version` will not be included in this case).
     *
     * Default value - `file`
     *
     * @var null|Type::* $type
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
     * @param null|Type::* $type
     */
    public static function new(
        ?string $fileType = null,
        ?string $limit = null,
        ?string $path = null,
        ?string $searchQuery = null,
        ?string $skip = null,
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
}
