<?php

declare(strict_types=1);

namespace ImageKit\Folders;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This will copy one folder into another. The selected folder, its nested folders, files, and their versions (in `includeVersions` is set to true) are copied in this operation. Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.
 */
final class FolderCopyParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    /**
     * Full path to the destination folder where you want to copy the source folder into.
     */
    #[Api]
    public string $destinationPath;

    /**
     * The full path to the source folder you want to copy.
     */
    #[Api]
    public string $sourceFolderPath;

    /**
     * Option to copy all versions of files that are nested inside the selected folder. By default, only the current version of each file will be copied. When set to true, all versions of each file will be copied. Default value - `false`.
     */
    #[Api(optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
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
        $obj = new self;

        $obj->destinationPath = $destinationPath;
        $obj->sourceFolderPath = $sourceFolderPath;

        null !== $includeVersions && $obj->includeVersions = $includeVersions;

        return $obj;
    }

    /**
     * Full path to the destination folder where you want to copy the source folder into.
     */
    public function withDestinationPath(string $destinationPath): self
    {
        $obj = clone $this;
        $obj->destinationPath = $destinationPath;

        return $obj;
    }

    /**
     * The full path to the source folder you want to copy.
     */
    public function withSourceFolderPath(string $sourceFolderPath): self
    {
        $obj = clone $this;
        $obj->sourceFolderPath = $sourceFolderPath;

        return $obj;
    }

    /**
     * Option to copy all versions of files that are nested inside the selected folder. By default, only the current version of each file will be copied. When set to true, all versions of each file will be copied. Default value - `false`.
     */
    public function withIncludeVersions(bool $includeVersions): self
    {
        $obj = clone $this;
        $obj->includeVersions = $includeVersions;

        return $obj;
    }
}
