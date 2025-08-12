<?php

declare(strict_types=1);

namespace ImageKit\Folder;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This will delete a folder and all its contents permanently. The API returns an empty response.
 *
 * @phpstan-type delete_params = array{folderPath: string}
 */
final class FolderDeleteParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Full path to the folder you want to delete. For example `/folder/to/delete/`.
     */
    #[Api]
    public string $folderPath;

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
    public static function from(string $folderPath): self
    {
        $obj = new self;

        $obj->folderPath = $folderPath;

        return $obj;
    }

    /**
     * Full path to the folder you want to delete. For example `/folder/to/delete/`.
     */
    public function setFolderPath(string $folderPath): self
    {
        $this->folderPath = $folderPath;

        return $this;
    }
}
