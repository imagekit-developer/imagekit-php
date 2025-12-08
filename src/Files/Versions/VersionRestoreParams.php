<?php

declare(strict_types=1);

namespace Imagekit\Files\Versions;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This API restores a file version as the current file version.
 *
 * @see Imagekit\Services\Files\VersionsService::restore()
 *
 * @phpstan-type VersionRestoreParamsShape = array{fileId: string}
 */
final class VersionRestoreParams implements BaseModel
{
    /** @use SdkModel<VersionRestoreParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $fileId;

    /**
     * `new VersionRestoreParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VersionRestoreParams::with(fileId: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VersionRestoreParams)->withFileID(...)
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
    public static function with(string $fileId): self
    {
        $obj = new self;

        $obj['fileId'] = $fileId;

        return $obj;
    }

    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj['fileId'] = $fileID;

        return $obj;
    }
}
