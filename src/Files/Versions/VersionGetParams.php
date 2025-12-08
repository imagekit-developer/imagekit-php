<?php

declare(strict_types=1);

namespace Imagekit\Files\Versions;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This API returns an object with details or attributes of a file version.
 *
 * @see Imagekit\Services\Files\VersionsService::get()
 *
 * @phpstan-type VersionGetParamsShape = array{fileId: string}
 */
final class VersionGetParams implements BaseModel
{
    /** @use SdkModel<VersionGetParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $fileId;

    /**
     * `new VersionGetParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VersionGetParams::with(fileId: ...)
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
