<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\Contracts\FoldersContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Util;
use ImageKit\Folders\FolderCopyParams;
use ImageKit\Folders\FolderCreateParams;
use ImageKit\Folders\FolderDeleteParams;
use ImageKit\Folders\FolderMoveParams;
use ImageKit\Folders\FolderRenameParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Folders\FolderCopyResponse;
use ImageKit\Responses\Folders\FolderDeleteResponse;
use ImageKit\Responses\Folders\FolderMoveResponse;
use ImageKit\Responses\Folders\FolderNewResponse;
use ImageKit\Responses\Folders\FolderRenameResponse;
use ImageKit\Services\Folders\JobService;

final class FoldersService implements FoldersContract
{
    public JobService $job;

    public function __construct(private Client $client)
    {
        $this->job = new JobService($this->client);
    }

    /**
     * This will create a new folder. You can specify the folder name and location of the parent folder where this new folder should be created.
     *
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
    ): FolderNewResponse {
        $args = [
            'folderName' => $folderName, 'parentFolderPath' => $parentFolderPath,
        ];
        [$parsed, $options] = FolderCreateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/folder',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FolderNewResponse::class, value: $resp);
    }

    /**
     * This will delete a folder and all its contents permanently. The API returns an empty response.
     *
     * @param string $folderPath Full path to the folder you want to delete. For example `/folder/to/delete/`.
     */
    public function delete(
        $folderPath,
        ?RequestOptions $requestOptions = null
    ): FolderDeleteResponse {
        $args = ['folderPath' => $folderPath];
        [$parsed, $options] = FolderDeleteParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'delete',
            path: 'v1/folder',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FolderDeleteResponse::class, value: $resp);
    }

    /**
     * This will copy one folder into another. The selected folder, its nested folders, files, and their versions (in `includeVersions` is set to true) are copied in this operation. Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.
     *
     * @param string $destinationPath full path to the destination folder where you want to copy the source folder into
     * @param string $sourceFolderPath the full path to the source folder you want to copy
     * @param bool $includeVersions Option to copy all versions of files that are nested inside the selected folder. By default, only the current version of each file will be copied. When set to true, all versions of each file will be copied. Default value - `false`.
     */
    public function copy(
        $destinationPath,
        $sourceFolderPath,
        $includeVersions = null,
        ?RequestOptions $requestOptions = null,
    ): FolderCopyResponse {
        $args = [
            'destinationPath' => $destinationPath,
            'sourceFolderPath' => $sourceFolderPath,
            'includeVersions' => $includeVersions,
        ];
        $args = Util::array_filter_null($args, ['includeVersions']);
        [$parsed, $options] = FolderCopyParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/bulkJobs/copyFolder',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FolderCopyResponse::class, value: $resp);
    }

    /**
     * This will move one folder into another. The selected folder, its nested folders, files, and their versions are moved in this operation. Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.
     *
     * @param string $destinationPath full path to the destination folder where you want to move the source folder into
     * @param string $sourceFolderPath the full path to the source folder you want to move
     */
    public function move(
        $destinationPath,
        $sourceFolderPath,
        ?RequestOptions $requestOptions = null
    ): FolderMoveResponse {
        $args = [
            'destinationPath' => $destinationPath,
            'sourceFolderPath' => $sourceFolderPath,
        ];
        [$parsed, $options] = FolderMoveParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/bulkJobs/moveFolder',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FolderMoveResponse::class, value: $resp);
    }

    /**
     * This API allows you to rename an existing folder. The folder and all its nested assets and sub-folders will remain unchanged, but their paths will be updated to reflect the new folder name.
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
     */
    public function rename(
        $folderPath,
        $newFolderName,
        $purgeCache = null,
        ?RequestOptions $requestOptions = null,
    ): FolderRenameResponse {
        $args = [
            'folderPath' => $folderPath,
            'newFolderName' => $newFolderName,
            'purgeCache' => $purgeCache,
        ];
        $args = Util::array_filter_null($args, ['purgeCache']);
        [$parsed, $options] = FolderRenameParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/bulkJobs/renameFolder',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FolderRenameResponse::class, value: $resp);
    }
}
