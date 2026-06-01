<?php

declare(strict_types=1);

namespace ImageKit\Assets\Versions;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Returns details of a single version of a file.
 *
 * @see ImageKit\Services\Assets\VersionsService::get()
 *
 * @phpstan-type VersionGetParamsShape = array{assetID: string}
 */
final class VersionGetParams implements BaseModel
{
    /** @use SdkModel<VersionGetParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $assetID;

    /**
     * `new VersionGetParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VersionGetParams::with(assetID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VersionGetParams)->withAssetID(...)
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
