<?php

declare(strict_types=1);

namespace Imagekit\Files\Bulk;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This API removes tags from multiple files in bulk. A maximum of 50 files can be specified at a time.
 *
 * @see Imagekit\Services\Files\BulkService::removeTags()
 *
 * @phpstan-type BulkRemoveTagsParamsShape = array{
 *   fileIds: list<string>, tags: list<string>
 * }
 */
final class BulkRemoveTagsParams implements BaseModel
{
    /** @use SdkModel<BulkRemoveTagsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * An array of fileIds from which you want to remove tags.
     *
     * @var list<string> $fileIds
     */
    #[Required(list: 'string')]
    public array $fileIds;

    /**
     * An array of tags that you want to remove from the files.
     *
     * @var list<string> $tags
     */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * `new BulkRemoveTagsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkRemoveTagsParams::with(fileIds: ..., tags: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkRemoveTagsParams)->withFileIDs(...)->withTags(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $fileIds
     * @param list<string> $tags
     */
    public static function with(array $fileIds, array $tags): self
    {
        $obj = new self;

        $obj['fileIds'] = $fileIds;
        $obj['tags'] = $tags;

        return $obj;
    }

    /**
     * An array of fileIds from which you want to remove tags.
     *
     * @param list<string> $fileIDs
     */
    public function withFileIDs(array $fileIDs): self
    {
        $obj = clone $this;
        $obj['fileIds'] = $fileIDs;

        return $obj;
    }

    /**
     * An array of tags that you want to remove from the files.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $obj = clone $this;
        $obj['tags'] = $tags;

        return $obj;
    }
}
