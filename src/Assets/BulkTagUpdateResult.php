<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type BulkTagUpdateResultShape = array{successfulAssetIDs: list<string>}
 */
final class BulkTagUpdateResult implements BaseModel
{
    /** @use SdkModel<BulkTagUpdateResultShape> */
    use SdkModel;

    /**
     * Array of `asset_id`s whose tags were updated successfully.
     *
     * @var list<string> $successfulAssetIDs
     */
    #[Required('successful_asset_ids', list: 'string')]
    public array $successfulAssetIDs;

    /**
     * `new BulkTagUpdateResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkTagUpdateResult::with(successfulAssetIDs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkTagUpdateResult)->withSuccessfulAssetIDs(...)
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
     * @param list<string> $successfulAssetIDs
     */
    public static function with(array $successfulAssetIDs): self
    {
        $self = new self;

        $self['successfulAssetIDs'] = $successfulAssetIDs;

        return $self;
    }

    /**
     * Array of `asset_id`s whose tags were updated successfully.
     *
     * @param list<string> $successfulAssetIDs
     */
    public function withSuccessfulAssetIDs(array $successfulAssetIDs): self
    {
        $self = clone $this;
        $self['successfulAssetIDs'] = $successfulAssetIDs;

        return $self;
    }
}
