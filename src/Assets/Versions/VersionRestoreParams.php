<?php

declare(strict_types=1);

namespace ImageKit\Assets\Versions;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Restores a file version as the current file version.
 *
 * @see ImageKit\Services\Assets\VersionsService::restore()
 *
 * @phpstan-type VersionRestoreParamsShape = array{assetID: string}
 */
final class VersionRestoreParams implements BaseModel
{
    /** @use SdkModel<VersionRestoreParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $assetID;

    /**
     * `new VersionRestoreParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VersionRestoreParams::with(assetID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VersionRestoreParams)->withAssetID(...)
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

    public function withAssetID(string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

        return $self;
    }
}
