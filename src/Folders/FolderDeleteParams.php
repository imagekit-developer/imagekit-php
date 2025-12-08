<?php

declare(strict_types=1);

namespace Imagekit\Folders;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This will delete a folder and all its contents permanently. The API returns an empty response.
 *
 * @see Imagekit\Services\FoldersService::delete()
 *
 * @phpstan-type FolderDeleteParamsShape = array{folderPath: string}
 */
final class FolderDeleteParams implements BaseModel
{
    /** @use SdkModel<FolderDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Full path to the folder you want to delete. For example `/folder/to/delete/`.
     */
    #[Api]
    public string $folderPath;

    /**
     * `new FolderDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FolderDeleteParams::with(folderPath: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FolderDeleteParams)->withFolderPath(...)
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
    public static function with(string $folderPath): self
    {
        $obj = new self;

        $obj['folderPath'] = $folderPath;

        return $obj;
    }

    /**
     * Full path to the folder you want to delete. For example `/folder/to/delete/`.
     */
    public function withFolderPath(string $folderPath): self
    {
        $obj = clone $this;
        $obj['folderPath'] = $folderPath;

        return $obj;
    }
}
