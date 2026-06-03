<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Moves a file (and all its versions) or a folder (with all nested folders, files, and their versions) from one location to another. Pass a file path or a folder path in `source_path`.
 *
 * - **File move** is synchronous and returns `204 No Content`.
 * - **Folder move** is asynchronous — the API returns `202 Accepted` with a `job_id`. Use the [get job status](#operation/get-job-status) API to track progress.
 *
 * Note: If a file at the destination has the same name as a source file, the source file and its versions will be appended to the destination file.
 *
 * @see ImageKit\Services\AssetsService::move()
 *
 * @phpstan-type AssetMoveParamsShape = array{
 *   destinationPath: string, sourcePath: string
 * }
 */
final class AssetMoveParams implements BaseModel
{
    /** @use SdkModel<AssetMoveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Full path of the destination folder.
     */
    #[Required('destination_path')]
    public string $destinationPath;

    /**
     * Full path of the file or folder you want to move.
     */
    #[Required('source_path')]
    public string $sourcePath;

    /**
     * `new AssetMoveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetMoveParams::with(destinationPath: ..., sourcePath: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetMoveParams)->withDestinationPath(...)->withSourcePath(...)
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
    public static function with(
        string $destinationPath,
        string $sourcePath
    ): self {
        $self = new self;

        $self['destinationPath'] = $destinationPath;
        $self['sourcePath'] = $sourcePath;

        return $self;
    }

    /**
     * Full path of the destination folder.
     */
    public function withDestinationPath(string $destinationPath): self
    {
        $self = clone $this;
        $self['destinationPath'] = $destinationPath;

        return $self;
    }

    /**
     * Full path of the file or folder you want to move.
     */
    public function withSourcePath(string $sourcePath): self
    {
        $self = clone $this;
        $self['sourcePath'] = $sourcePath;

        return $self;
    }
}
