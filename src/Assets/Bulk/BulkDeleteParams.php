<?php

declare(strict_types=1);

namespace ImageKit\Assets\Bulk;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Permanently deletes multiple assets — files (including all of their versions) and folders (including their contents) — in a single request. Identify each asset by its `asset_id`.
 *
 * A maximum of 100 assets can be deleted in one request.
 *
 * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting an asset does not purge the cache. Use the purge cache API to purge cached URLs.
 *
 * @see ImageKit\Services\Assets\BulkService::delete()
 *
 * @phpstan-type BulkDeleteParamsShape = array{assetIDs: list<string>}
 */
final class BulkDeleteParams implements BaseModel
{
    /** @use SdkModel<BulkDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * An array of asset ids to delete. Each id can refer to a file or a folder, as returned by the list and search assets, upload, or create folder APIs.
     *
     * @var list<string> $assetIDs
     */
    #[Required('asset_ids', list: 'string')]
    public array $assetIDs;

    /**
     * `new BulkDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkDeleteParams::with(assetIDs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkDeleteParams)->withAssetIDs(...)
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
     */
    public static function with(array $assetIDs): self
    {
        $self = new self;

        $self['assetIDs'] = $assetIDs;

        return $self;
    }

    /**
     * An array of asset ids to delete. Each id can refer to a file or a folder, as returned by the list and search assets, upload, or create folder APIs.
     *
     * @param list<string> $assetIDs
     */
    public function withAssetIDs(array $assetIDs): self
    {
        $self = clone $this;
        $self['assetIDs'] = $assetIDs;

        return $self;
    }
}
