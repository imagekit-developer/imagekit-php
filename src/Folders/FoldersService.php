<?php

declare(strict_types=1);

namespace ImageKit\Folders;

use ImageKit\Client;
use ImageKit\Contracts\FoldersContract;
use ImageKit\Core\Conversion;
use ImageKit\Folders\Job\JobService;
use ImageKit\RequestOptions;
use ImageKit\Responses\Folders\FolderCopyResponse;
use ImageKit\Responses\Folders\FolderDeleteResponse;
use ImageKit\Responses\Folders\FolderMoveResponse;
use ImageKit\Responses\Folders\FolderNewResponse;
use ImageKit\Responses\Folders\FolderRenameResponse;

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
     * @param array{
     *   folderName: string, parentFolderPath: string
     * }|FolderCreateParams $params
     */
    public function create(
        array|FolderCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderNewResponse {
        [$parsed, $options] = FolderCreateParams::parseRequest(
            $params,
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
     * @param array{folderPath: string}|FolderDeleteParams $params
     */
    public function delete(
        array|FolderDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderDeleteResponse {
        [$parsed, $options] = FolderDeleteParams::parseRequest(
            $params,
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
     * @param array{
     *   destinationPath: string, sourceFolderPath: string, includeVersions?: bool
     * }|FolderCopyParams $params
     */
    public function copy(
        array|FolderCopyParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderCopyResponse {
        [$parsed, $options] = FolderCopyParams::parseRequest(
            $params,
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
     * @param array{
     *   destinationPath: string, sourceFolderPath: string
     * }|FolderMoveParams $params
     */
    public function move(
        array|FolderMoveParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderMoveResponse {
        [$parsed, $options] = FolderMoveParams::parseRequest(
            $params,
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
     * @param array{
     *   folderPath: string, newFolderName: string, purgeCache?: bool
     * }|FolderRenameParams $params
     */
    public function rename(
        array|FolderRenameParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderRenameResponse {
        [$parsed, $options] = FolderRenameParams::parseRequest(
            $params,
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
