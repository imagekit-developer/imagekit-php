<?php

declare(strict_types=1);

namespace ImageKit\Files\Bulk;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API adds tags to multiple files in bulk. A maximum of 50 files can be specified at a time.
 *
 * @see ImageKit\Services\Files\BulkService::addTags()
 *
 * @phpstan-type BulkAddTagsParamsShape = array{
 *   fileIds: list<string>, tags: list<string>
 * }
 */
final class BulkAddTagsParams implements BaseModel
{
    /** @use SdkModel<BulkAddTagsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * An array of fileIds to which you want to add tags.
     *
     * @var list<string> $fileIds
     */
    #[Api(list: 'string')]
    public array $fileIds;

    /**
     * An array of tags that you want to add to the files.
     *
     * @var list<string> $tags
     */
    #[Api(list: 'string')]
    public array $tags;

    /**
     * `new BulkAddTagsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkAddTagsParams::with(fileIds: ..., tags: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkAddTagsParams)->withFileIDs(...)->withTags(...)
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

        $obj->fileIds = $fileIds;
        $obj->tags = $tags;

        return $obj;
    }

    /**
     * An array of fileIds to which you want to add tags.
     *
     * @param list<string> $fileIDs
     */
    public function withFileIDs(array $fileIDs): self
    {
        $obj = clone $this;
        $obj->fileIds = $fileIDs;

        return $obj;
    }

    /**
     * An array of tags that you want to add to the files.
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
