<?php

declare(strict_types=1);

namespace ImageKit\Assets\Bulk;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Removes user-applied tags and/or AI-generated tags from multiple files in a single call. A maximum of 50 files can be specified per request.
 *
 * At least one of `tags` or `ai_tags` must be provided. Both may be specified together; each list is removed from the corresponding tag set on every file. Tags that are not present on a file are silently ignored.
 *
 * @see ImageKit\Services\Assets\BulkService::removeTags()
 *
 * @phpstan-type BulkRemoveTagsParamsShape = array{
 *   assetIDs: list<string>, aiTags?: list<string>|null, tags?: list<string>|null
 * }
 */
final class BulkRemoveTagsParams implements BaseModel
{
    /** @use SdkModel<BulkRemoveTagsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Array of file `asset_id`s from which the tags will be removed.
     *
     * @var list<string> $assetIDs
     */
    #[Required('asset_ids', list: 'string')]
    public array $assetIDs;

    /**
     * AI-generated tags to remove from each file.
     *
     * @var list<string>|null $aiTags
     */
    #[Optional('ai_tags', list: 'string')]
    public ?array $aiTags;

    /**
     * User-applied tags to remove from each file.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new BulkRemoveTagsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkRemoveTagsParams::with(assetIDs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkRemoveTagsParams)->withAssetIDs(...)
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
     * @param list<string>|null $aiTags
     * @param list<string>|null $tags
     */
    public static function with(
        array $assetIDs,
        ?array $aiTags = null,
        ?array $tags = null
    ): self {
        $self = new self;

        $self['assetIDs'] = $assetIDs;

        null !== $aiTags && $self['aiTags'] = $aiTags;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * Array of file `asset_id`s from which the tags will be removed.
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
     * AI-generated tags to remove from each file.
     *
     * @param list<string> $aiTags
     */
    public function withAITags(array $aiTags): self
    {
        $self = clone $this;
        $self['aiTags'] = $aiTags;

        return $self;
    }

    /**
     * User-applied tags to remove from each file.
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
