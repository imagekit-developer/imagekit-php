<?php

declare(strict_types=1);

namespace ImageKit\Folder;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This will create a new folder. You can specify the folder name and location of the parent folder where this new folder should be created.
 *
 * @phpstan-type create_params = array{
 *   folderName: string, parentFolderPath: string
 * }
 */
final class FolderCreateParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * The folder will be created with this name.
     *
     * All characters except alphabets and numbers (inclusive of unicode letters, marks, and numerals in other languages) will be replaced by an underscore i.e. `_`.
     */
    #[Api]
    public string $folderName;

    /**
     * The folder where the new folder should be created, for root use `/` else the path e.g. `containing/folder/`.
     *
     * Note: If any folder(s) is not present in the parentFolderPath parameter, it will be automatically created. For example, if you pass `/product/images/summer`, then `product`, `images`, and `summer` folders will be created if they don't already exist.
     */
    #[Api]
    public string $parentFolderPath;

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
    public static function new(
        string $folderName,
        string $parentFolderPath
    ): self {
        $obj = new self;

        $obj->folderName = $folderName;
        $obj->parentFolderPath = $parentFolderPath;

        return $obj;
    }
}
