<?php

declare(strict_types=1);

namespace ImageKit\Files\Versions;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API returns an object with details or attributes of a file version.
 *
 * @see ImageKit\Files\Versions->get
 *
 * @phpstan-type version_get_params = array{fileID: string}
 */
final class VersionGetParams implements BaseModel
{
    /** @use SdkModel<version_get_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
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
        $obj = new self;

        $obj->fileID = $fileID;

        return $obj;
    }

    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj->fileID = $fileID;

        return $obj;
    }
}
