<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type BulkAssetsNotFoundErrorShape = array{
 *   message: string, missingAssetIDs: list<string>
 * }
 */
final class BulkAssetsNotFoundError implements BaseModel
{
    /** @use SdkModel<BulkAssetsNotFoundErrorShape> */
    use SdkModel;

    #[Required]
    public string $message;

    /**
     * Array of `asset_id`s that were not found.
     *
     * @var list<string> $missingAssetIDs
     */
    #[Required('missing_asset_ids', list: 'string')]
    public array $missingAssetIDs;

    /**
     * `new BulkAssetsNotFoundError()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkAssetsNotFoundError::with(message: ..., missingAssetIDs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkAssetsNotFoundError)->withMessage(...)->withMissingAssetIDs(...)
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
     * @param list<string> $missingAssetIDs
     */
    public static function with(string $message, array $missingAssetIDs): self
    {
        $self = new self;

        $self['message'] = $message;
        $self['missingAssetIDs'] = $missingAssetIDs;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Array of `asset_id`s that were not found.
     *
     * @param list<string> $missingAssetIDs
     */
    public function withMissingAssetIDs(array $missingAssetIDs): self
    {
        $self = clone $this;
        $self['missingAssetIDs'] = $missingAssetIDs;

        return $self;
    }
}
