<?php

declare(strict_types=1);

namespace Imagekit\Folders;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * This API allows you to rename an existing folder. The folder and all its nested assets and sub-folders will remain unchanged, but their paths will be updated to reflect the new folder name.
 *
 * @see Imagekit\Services\FoldersService::rename()
 *
 * @phpstan-type FolderRenameParamsShape = array{
 *   folderPath: string, newFolderName: string, purgeCache?: bool
 * }
 */
final class FolderRenameParams implements BaseModel
{
    /** @use SdkModel<FolderRenameParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The full path to the folder you want to rename.
     */
    #[Required]
    public string $folderPath;

    /**
     * The new name for the folder.
     *
     * All characters except alphabets and numbers (inclusive of unicode letters, marks, and numerals in other languages) and `-` will be replaced by an underscore i.e. `_`.
     */
    #[Required]
    public string $newFolderName;

    /**
     * Option to purge cache for the old nested files and their versions' URLs.
     *
     * When set to true, it will internally issue a purge cache request on CDN to remove the cached content of the old nested files and their versions. There will only be one purge request for all the nested files, which will be counted against your monthly purge quota.
     *
     * Note: A purge cache request will be issued against `https://ik.imagekit.io/old/folder/path*` (with a wildcard at the end). This will remove all nested files, their versions' URLs, and any transformations made using query parameters on these files or their versions. However, the cache for file transformations made using path parameters will persist. You can purge them using the purge API. For more details, refer to the purge API documentation.
     *
     * Default value - `false`
     */
    #[Optional]
    public ?bool $purgeCache;

    /**
     * `new FolderRenameParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FolderRenameParams::with(folderPath: ..., newFolderName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FolderRenameParams)->withFolderPath(...)->withNewFolderName(...)
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
        string $folderPath,
        string $newFolderName,
        ?bool $purgeCache = null
    ): self {
        $self = new self;

        $self['folderPath'] = $folderPath;
        $self['newFolderName'] = $newFolderName;

        null !== $purgeCache && $self['purgeCache'] = $purgeCache;

        return $self;
    }

    /**
     * The full path to the folder you want to rename.
     */
    public function withFolderPath(string $folderPath): self
    {
        $self = clone $this;
        $self['folderPath'] = $folderPath;

        return $self;
    }

    /**
     * The new name for the folder.
     *
     * All characters except alphabets and numbers (inclusive of unicode letters, marks, and numerals in other languages) and `-` will be replaced by an underscore i.e. `_`.
     */
    public function withNewFolderName(string $newFolderName): self
    {
        $self = clone $this;
        $self['newFolderName'] = $newFolderName;

        return $self;
    }

    /**
     * Option to purge cache for the old nested files and their versions' URLs.
     *
     * When set to true, it will internally issue a purge cache request on CDN to remove the cached content of the old nested files and their versions. There will only be one purge request for all the nested files, which will be counted against your monthly purge quota.
     *
     * Note: A purge cache request will be issued against `https://ik.imagekit.io/old/folder/path*` (with a wildcard at the end). This will remove all nested files, their versions' URLs, and any transformations made using query parameters on these files or their versions. However, the cache for file transformations made using path parameters will persist. You can purge them using the purge API. For more details, refer to the purge API documentation.
     *
     * Default value - `false`
     */
    public function withPurgeCache(bool $purgeCache): self
    {
        $self = clone $this;
        $self['purgeCache'] = $purgeCache;

        return $self;
    }
}
