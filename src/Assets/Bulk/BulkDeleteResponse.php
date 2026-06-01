<?php

declare(strict_types=1);

namespace ImageKit\Assets\Bulk;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type BulkDeleteResponseShape = array{
 *   successfullyDeletedAssetIDs: list<string>
 * }
 */
final class BulkDeleteResponse implements BaseModel
{
    /** @use SdkModel<BulkDeleteResponseShape> */
    use SdkModel;

    /**
     * Asset ids that were successfully deleted.
     *
     * @var list<string> $successfullyDeletedAssetIDs
     */
    #[Required('successfully_deleted_asset_ids', list: 'string')]
    public array $successfullyDeletedAssetIDs;

    /**
     * `new BulkDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkDeleteResponse::with(successfullyDeletedAssetIDs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkDeleteResponse)->withSuccessfullyDeletedAssetIDs(...)
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
     * @param list<string> $successfullyDeletedAssetIDs
     */
    public static function with(array $successfullyDeletedAssetIDs): self
    {
        $self = new self;

        $self['successfullyDeletedAssetIDs'] = $successfullyDeletedAssetIDs;

        return $self;
    }

    /**
     * Asset ids that were successfully deleted.
     *
     * @param list<string> $successfullyDeletedAssetIDs
     */
    public function withSuccessfullyDeletedAssetIDs(
        array $successfullyDeletedAssetIDs
    ): self {
        $self = clone $this;
        $self['successfullyDeletedAssetIDs'] = $successfullyDeletedAssetIDs;

        return $self;
    }
}
