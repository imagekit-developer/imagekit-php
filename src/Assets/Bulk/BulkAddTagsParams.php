<?php

declare(strict_types=1);

namespace ImageKit\Assets\Bulk;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Adds one or more tags to multiple files in a single call. A maximum of 50 files can be specified per request.
 *
 * Tags are merged with any tags already present on each file; duplicates are ignored.
 *
 * @see ImageKit\Services\Assets\BulkService::addTags()
 *
 * @phpstan-type BulkAddTagsParamsShape = array{
 *   assetIDs: list<string>, tags: list<string>
 * }
 */
final class BulkAddTagsParams implements BaseModel
{
    /** @use SdkModel<BulkAddTagsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Array of file `asset_id`s to which the tags will be added.
     *
     * @var list<string> $assetIDs
     */
    #[Required('asset_ids', list: 'string')]
    public array $assetIDs;

    /**
     * Array of tags to add. Combined length of all tags must not exceed 500 characters.
     *
     * @var list<string> $tags
     */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * `new BulkAddTagsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkAddTagsParams::with(assetIDs: ..., tags: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkAddTagsParams)->withAssetIDs(...)->withTags(...)
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
     * @param list<string> $assetIDs
     * @param list<string> $tags
     */
    public static function with(array $assetIDs, array $tags): self
    {
        $self = new self;

        $self['assetIDs'] = $assetIDs;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Array of file `asset_id`s to which the tags will be added.
     *
     * @param list<string> $assetIDs
     */
    public function withAssetIDs(array $assetIDs): self
    {
        $self = clone $this;
        $self['assetIDs'] = $assetIDs;

        return $self;
    }

    /**
     * Array of tags to add. Combined length of all tags must not exceed 500 characters.
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
