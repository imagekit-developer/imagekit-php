<?php

declare(strict_types=1);

namespace ImageKit\Assets\BulkTagUpdatePartialResult;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ErrorShape = array{assetID: string, error: string}
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * `asset_id` of the file that was not updated.
     */
    #[Required('asset_id')]
    public string $assetID;

    /**
     * Reason the file could not be updated.
     */
    #[Required]
    public string $error;

    /**
     * `new Error()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error::with(assetID: ..., error: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error)->withAssetID(...)->withError(...)
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
     */
    public static function with(string $assetID, string $error): self
    {
        $self = new self;

        $self['assetID'] = $assetID;
        $self['error'] = $error;

        return $self;
    }

    /**
     * `asset_id` of the file that was not updated.
     */
    public function withAssetID(string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

        return $self;
    }

    /**
     * Reason the file could not be updated.
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }
}
