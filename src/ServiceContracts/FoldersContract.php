<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

use Imagekit\Core\Exceptions\APIException;
use Imagekit\Folders\FolderCopyResponse;
use Imagekit\Folders\FolderDeleteResponse;
use Imagekit\Folders\FolderMoveResponse;
use Imagekit\Folders\FolderNewResponse;
use Imagekit\Folders\FolderRenameResponse;
use Imagekit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
interface FoldersContract
{
    /**
     * @api
     *
     * @param string $folderName The folder will be created with this name.
     *
     * All characters except alphabets and numbers (inclusive of unicode letters, marks, and numerals in other languages) will be replaced by an underscore i.e. `_`.
     * @param string $parentFolderPath The folder where the new folder should be created, for root use `/` else the path e.g. `containing/folder/`.
     *
     * Note: If any folder(s) is not present in the parentFolderPath parameter, it will be automatically created. For example, if you pass `/product/images/summer`, then `product`, `images`, and `summer` folders will be created if they don't already exist.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $folderName,
        string $parentFolderPath,
        RequestOptions|array|null $requestOptions = null,
    ): FolderNewResponse;

    /**
     * @api
     *
     * @param string $folderPath Full path to the folder you want to delete. For example `/folder/to/delete/`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $folderPath,
        RequestOptions|array|null $requestOptions = null
    ): FolderDeleteResponse;

    /**
     * @api
     *
     * @param string $destinationPath full path to the destination folder where you want to copy the source folder into
     * @param string $sourceFolderPath the full path to the source folder you want to copy
     * @param bool $includeVersions Option to copy all versions of files that are nested inside the selected folder. By default, only the current version of each file will be copied. When set to true, all versions of each file will be copied. Default value - `false`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function copy(
        string $destinationPath,
        string $sourceFolderPath,
        ?bool $includeVersions = null,
        RequestOptions|array|null $requestOptions = null,
    ): FolderCopyResponse;

    /**
     * @api
     *
     * @param string $destinationPath full path to the destination folder where you want to move the source folder into
     * @param string $sourceFolderPath the full path to the source folder you want to move
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function move(
        string $destinationPath,
        string $sourceFolderPath,
        RequestOptions|array|null $requestOptions = null,
    ): FolderMoveResponse;

    /**
     * @api
     *
     * @param string $folderPath the full path to the folder you want to rename
     * @param string $newFolderName The new name for the folder.
     *
     * All characters except alphabets and numbers (inclusive of unicode letters, marks, and numerals in other languages) and `-` will be replaced by an underscore i.e. `_`.
     * @param bool $purgeCache Option to purge cache for the old nested files and their versions' URLs.
     *
     * When set to true, it will internally issue a purge cache request on CDN to remove the cached content of the old nested files and their versions. There will only be one purge request for all the nested files, which will be counted against your monthly purge quota.
     *
     * Note: A purge cache request will be issued against `https://ik.imagekit.io/old/folder/path*` (with a wildcard at the end). This will remove all nested files, their versions' URLs, and any transformations made using query parameters on these files or their versions. However, the cache for file transformations made using path parameters will persist. You can purge them using the purge API. For more details, refer to the purge API documentation.
     *
     * Default value - `false`
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rename(
        string $folderPath,
        string $newFolderName,
        ?bool $purgeCache = null,
        RequestOptions|array|null $requestOptions = null,
    ): FolderRenameResponse;
}
