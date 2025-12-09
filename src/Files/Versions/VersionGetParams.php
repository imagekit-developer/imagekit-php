<?php

declare(strict_types=1);

namespace Imagekit\Files\Versions;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This API returns an object with details or attributes of a file version.
 *
 * @see Imagekit\Services\Files\VersionsService::get()
 *
 * @phpstan-type VersionGetParamsShape = array{fileID: string}
 */
final class VersionGetParams implements BaseModel
{
    /** @use SdkModel<VersionGetParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $fileID;

    /**
     * `new VersionGetParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VersionGetParams::with(fileID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VersionGetParams)->withFileID(...)
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
    public static function with(string $fileID): self
    {
        $self = new self;

        $self['fileID'] = $fileID;

        return $self;
    }

    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }
}
