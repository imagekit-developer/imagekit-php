<?php

declare(strict_types=1);

namespace ImageKit\Files\Bulk;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API removes tags from multiple files in bulk. A maximum of 50 files can be specified at a time.
 *
 * @see ImageKit\Services\Files\BulkService::removeTags()
 *
 * @phpstan-type BulkRemoveTagsParamsShape = array{
 *   fileIDs: list<string>, tags: list<string>
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
     * @var list<string> $fileIDs
     */
    #[Required('fileIds', list: 'string')]
    public array $fileIDs;

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
        $self = new self;

        $self['fileIDs'] = $fileIDs;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * An array of fileIds from which you want to remove tags.
     *
     * @param list<string> $fileIDs
     */
    public function withFileIDs(array $fileIDs): self
    {
        $self = clone $this;
        $self['fileIDs'] = $fileIDs;

        return $self;
    }

    /**
     * An array of tags that you want to remove from the files.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
