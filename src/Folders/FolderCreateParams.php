<?php

declare(strict_types=1);

namespace Imagekit\Folders;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This will create a new folder. You can specify the folder name and location of the parent folder where this new folder should be created.
 *
 * @see Imagekit\Services\FoldersService::create()
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
     * The folder will be created with this name.
     *
     * All characters except alphabets and numbers (inclusive of unicode letters, marks, and numerals in other languages) will be replaced by an underscore i.e. `_`.
     */
    #[Required]
    public string $folderName;

    /**
     * The folder where the new folder should be created, for root use `/` else the path e.g. `containing/folder/`.
     *
     * Note: If any folder(s) is not present in the parentFolderPath parameter, it will be automatically created. For example, if you pass `/product/images/summer`, then `product`, `images`, and `summer` folders will be created if they don't already exist.
     */
    #[Required]
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
     * The folder will be created with this name.
     *
     * All characters except alphabets and numbers (inclusive of unicode letters, marks, and numerals in other languages) will be replaced by an underscore i.e. `_`.
     */
    public function withFolderName(string $folderName): self
    {
        $self = clone $this;
        $self['folderName'] = $folderName;

        return $self;
    }

    /**
     * The folder where the new folder should be created, for root use `/` else the path e.g. `containing/folder/`.
     *
     * Note: If any folder(s) is not present in the parentFolderPath parameter, it will be automatically created. For example, if you pass `/product/images/summer`, then `product`, `images`, and `summer` folders will be created if they don't already exist.
     */
    public function withParentFolderPath(string $parentFolderPath): self
    {
        $self = clone $this;
        $self['parentFolderPath'] = $parentFolderPath;

        return $self;
    }
}
