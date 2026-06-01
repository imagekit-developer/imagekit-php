<?php

declare(strict_types=1);

namespace ImageKit\Assets\Folders;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type FolderNewResponseShape = array{assetID: string}
 */
final class FolderNewResponse implements BaseModel
{
    /** @use SdkModel<FolderNewResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the newly created folder.
     */
    #[Required('asset_id')]
    public string $assetID;

    /**
     * `new FolderNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FolderNewResponse::with(assetID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FolderNewResponse)->withAssetID(...)
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
    public static function with(string $assetID): self
    {
        $self = new self;

        $self['assetID'] = $assetID;

        return $self;
    }

    /**
     * Unique identifier of the newly created folder.
     */
    public function withAssetID(string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

        return $self;
    }
}
