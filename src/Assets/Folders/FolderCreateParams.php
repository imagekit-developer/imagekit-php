<?php

declare(strict_types=1);

namespace ImageKit\Assets\Folders;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Creates a new (empty) folder. Specify the folder name and the path of the parent folder under which the new folder should be created.
 *
 * If any folder in `parent_folder_path` does not exist, the missing folders are created automatically. For example, when `parent_folder_path` is `/product/images/summer`, the folders `product`, `images`, and `summer` are created if they don't already exist.
 *
 * @see ImageKit\Services\Assets\FoldersService::create()
 *
 * @phpstan-type FolderCreateParamsShape = array{
 *   folderName: string, parentFolderPath: string
 * }
 */
final class FolderCreateParams implements BaseModel
{
    /** @use SdkModel<FolderCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Name of the folder to create.
     *
     * All characters except alphabets and numbers (including Unicode letters, marks, and numerals in other languages) are replaced by an underscore `_`.
     */
    #[Required('folder_name')]
    public string $folderName;

    /**
     * Full path of the parent folder under which the new folder should be created. Use `/` for the root, otherwise a path like `/containing/folder/`.
     */
    #[Required('parent_folder_path')]
    public string $parentFolderPath;

    /**
     * `new FolderCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FolderCreateParams::with(folderName: ..., parentFolderPath: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FolderCreateParams)->withFolderName(...)->withParentFolderPath(...)
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
        string $folderName,
        string $parentFolderPath
    ): self {
        $self = new self;

        $self['folderName'] = $folderName;
        $self['parentFolderPath'] = $parentFolderPath;

        return $self;
    }

    /**
     * Name of the folder to create.
     *
     * All characters except alphabets and numbers (including Unicode letters, marks, and numerals in other languages) are replaced by an underscore `_`.
     */
    public function withFolderName(string $folderName): self
    {
        $self = clone $this;
        $self['folderName'] = $folderName;

        return $self;
    }

    /**
     * Full path of the parent folder under which the new folder should be created. Use `/` for the root, otherwise a path like `/containing/folder/`.
     */
    public function withParentFolderPath(string $parentFolderPath): self
    {
        $self = clone $this;
        $self['parentFolderPath'] = $parentFolderPath;

        return $self;
    }
}
