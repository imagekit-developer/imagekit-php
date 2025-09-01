<?php

declare(strict_types=1);

namespace ImageKit\Files\Bulk;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API removes tags from multiple files in bulk. A maximum of 50 files can be specified at a time.
 *
 * @see ImageKit\Files\Bulk->removeTags
 *
 * @phpstan-type bulk_remove_tags_params = array{
 *   fileIDs: list<string>, tags: list<string>
 * }
 */
final class BulkRemoveTagsParams implements BaseModel
{
    /** @use SdkModel<bulk_remove_tags_params> */
    use SdkModel;
    use SdkParams;

    /**
     * An array of fileIds from which you want to remove tags.
     *
     * @var list<string> $fileIDs
     */
    #[Api('fileIds', list: 'string')]
    public array $fileIDs;

    /**
     * An array of tags that you want to remove from the files.
     *
     * @var list<string> $tags
     */
    #[Api(list: 'string')]
    public array $tags;

    /**
     * `new BulkRemoveTagsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkRemoveTagsParams::with(fileIDs: ..., tags: ...)
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
     * @param list<string> $fileIDs
     * @param list<string> $tags
     */
    public static function with(array $fileIDs, array $tags): self
    {
        $obj = new self;

        $obj->fileIDs = $fileIDs;
        $obj->tags = $tags;

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
        $obj->fileIDs = $fileIDs;

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
        $obj->tags = $tags;

        return $obj;
    }
}
