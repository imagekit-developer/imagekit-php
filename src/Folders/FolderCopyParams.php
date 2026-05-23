<?php

declare(strict_types=1);

namespace ImageKit\Folders;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This will copy one folder into another. The selected folder, its nested folders, files, and their versions (in `includeVersions` is set to true) are copied in this operation. Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.
 *
 * @see ImageKit\Services\FoldersService::copy()
 *
 * @phpstan-type FolderCopyParamsShape = array{
 *   destinationPath: string, sourceFolderPath: string, includeVersions?: bool|null
 * }
 */
final class FolderCopyParams implements BaseModel
{
    /** @use SdkModel<FolderCopyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Full path to the destination folder where you want to copy the source folder into.
     */
    #[Required]
    public string $destinationPath;

    /**
     * The full path to the source folder you want to copy.
     */
    #[Required]
    public string $sourceFolderPath;

    /**
     * Option to copy all versions of files that are nested inside the selected folder. By default, only the current version of each file will be copied. When set to true, all versions of each file will be copied. Default value - `false`.
     */
    #[Optional]
    public ?bool $includeVersions;

    /**
     * `new FolderCopyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FolderCopyParams::with(destinationPath: ..., sourceFolderPath: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FolderCopyParams)->withDestinationPath(...)->withSourceFolderPath(...)
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
        string $sourceFolderPath,
        ?bool $includeVersions = null,
    ): self {
        $self = new self;

        $self['destinationPath'] = $destinationPath;
        $self['sourceFolderPath'] = $sourceFolderPath;

        null !== $includeVersions && $self['includeVersions'] = $includeVersions;

        return $self;
    }

    /**
     * Full path to the destination folder where you want to copy the source folder into.
     */
    public function withDestinationPath(string $destinationPath): self
    {
        $self = clone $this;
        $self['destinationPath'] = $destinationPath;

        return $self;
    }

    /**
     * The full path to the source folder you want to copy.
     */
    public function withSourceFolderPath(string $sourceFolderPath): self
    {
        $self = clone $this;
        $self['sourceFolderPath'] = $sourceFolderPath;

        return $self;
    }

    /**
     * Option to copy all versions of files that are nested inside the selected folder. By default, only the current version of each file will be copied. When set to true, all versions of each file will be copied. Default value - `false`.
     */
    public function withIncludeVersions(bool $includeVersions): self
    {
        $self = clone $this;
        $self['includeVersions'] = $includeVersions;

        return $self;
    }
}
