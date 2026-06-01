<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Copies a file or a folder from one location to another. Pass a file path or a folder path in `source_path`.
 *
 * - **File copy** is synchronous and returns `204 No Content`.
 * - **Folder copy** is asynchronous — the selected folder along with its nested folders, files, and (optionally) file versions are copied in the background. The API returns `202 Accepted` with a `job_id`. Use the [get job status](#operation/get-job-status) API to track progress.
 *
 * Note: If a file at the destination has the same name as a source file, the source file (and its versions, when `include_versions` is `true`) will be appended to the destination file's version history.
 *
 * @see ImageKit\Services\AssetsService::copy()
 *
 * @phpstan-type AssetCopyParamsShape = array{
 *   destinationPath: string, sourcePath: string, includeVersions?: bool|null
 * }
 */
final class AssetCopyParams implements BaseModel
{
    /** @use SdkModel<AssetCopyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Full path of the destination folder.
     */
    #[Required('destination_path')]
    public string $destinationPath;

    /**
     * Full path of the file or folder you want to copy.
     */
    #[Required('source_path')]
    public string $sourcePath;

    /**
     * When `true`, all versions of the source file(s) are copied. When `false` (default), only the current version is copied. Applies to both file and folder copy operations.
     */
    #[Optional('include_versions')]
    public ?bool $includeVersions;

    /**
     * `new AssetCopyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetCopyParams::with(destinationPath: ..., sourcePath: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetCopyParams)->withDestinationPath(...)->withSourcePath(...)
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
        string $sourcePath,
        ?bool $includeVersions = null
    ): self {
        $self = new self;

        $self['destinationPath'] = $destinationPath;
        $self['sourcePath'] = $sourcePath;

        null !== $includeVersions && $self['includeVersions'] = $includeVersions;

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
     * Full path of the file or folder you want to copy.
     */
    public function withSourcePath(string $sourcePath): self
    {
        $self = clone $this;
        $self['sourcePath'] = $sourcePath;

        return $self;
    }

    /**
     * When `true`, all versions of the source file(s) are copied. When `false` (default), only the current version is copied. Applies to both file and folder copy operations.
     */
    public function withIncludeVersions(bool $includeVersions): self
    {
        $self = clone $this;
        $self['includeVersions'] = $includeVersions;

        return $self;
    }
}
