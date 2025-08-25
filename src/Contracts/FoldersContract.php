<?php

declare(strict_types=1);

namespace ImageKit\Contracts;

use ImageKit\Folders\AsyncBulkJobResponse;
use ImageKit\RequestOptions;
use ImageKit\Responses\Folders\FolderDeleteResponse;
use ImageKit\Responses\Folders\FolderNewResponse;

interface FoldersContract
{
    /**
     * @param string $folderName The folder will be created with this name.
     *
     * All characters except alphabets and numbers (inclusive of unicode letters, marks, and numerals in other languages) will be replaced by an underscore i.e. `_`.
     * @param string $parentFolderPath The folder where the new folder should be created, for root use `/` else the path e.g. `containing/folder/`.
     *
     * Note: If any folder(s) is not present in the parentFolderPath parameter, it will be automatically created. For example, if you pass `/product/images/summer`, then `product`, `images`, and `summer` folders will be created if they don't already exist.
     */
    public function create(
        $folderName,
        $parentFolderPath,
        ?RequestOptions $requestOptions = null
    ): FolderNewResponse;

    /**
     * @param string $folderPath Full path to the folder you want to delete. For example `/folder/to/delete/`.
     */
    public function delete(
        $folderPath,
        ?RequestOptions $requestOptions = null
    ): FolderDeleteResponse;

    /**
     * @param string $destinationPath full path to the destination folder where you want to copy the source folder into
     * @param string $sourceFolderPath the full path to the source folder you want to copy
     * @param bool $includeVersions Option to copy all versions of files that are nested inside the selected folder. By default, only the current version of each file will be copied. When set to true, all versions of each file will be copied. Default value - `false`.
     */
    public function copy(
        $destinationPath,
        $sourceFolderPath,
        $includeVersions = null,
        ?RequestOptions $requestOptions = null,
    ): AsyncBulkJobResponse;

    /**
     * @param string $destinationPath full path to the destination folder where you want to move the source folder into
     * @param string $sourceFolderPath the full path to the source folder you want to move
     */
    public function move(
        $destinationPath,
        $sourceFolderPath,
        ?RequestOptions $requestOptions = null,
    ): AsyncBulkJobResponse;

    /**
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
     */
    public function rename(
        $folderPath,
        $newFolderName,
        $purgeCache = null,
        ?RequestOptions $requestOptions = null,
    ): AsyncBulkJobResponse;
}
