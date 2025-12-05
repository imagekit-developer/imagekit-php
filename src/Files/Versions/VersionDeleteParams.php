<?php

declare(strict_types=1);

namespace ImageKit\Files\Versions;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API deletes a non-current file version permanently. The API returns an empty response.
 *
 * Note: If you want to delete all versions of a file, use the delete file API.
 *
 * @see ImageKit\Services\Files\VersionsService::delete()
 *
 * @phpstan-type VersionDeleteParamsShape = array{fileId: string}
 */
final class VersionDeleteParams implements BaseModel
{
    /** @use SdkModel<VersionDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $fileId;

    /**
     * `new VersionDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VersionDeleteParams::with(fileId: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VersionDeleteParams)->withFileID(...)
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
