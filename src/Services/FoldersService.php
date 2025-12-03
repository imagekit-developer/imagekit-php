<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Folders\FolderCopyParams;
use ImageKit\Folders\FolderCopyResponse;
use ImageKit\Folders\FolderCreateParams;
use ImageKit\Folders\FolderDeleteParams;
use ImageKit\Folders\FolderDeleteResponse;
use ImageKit\Folders\FolderMoveParams;
use ImageKit\Folders\FolderMoveResponse;
use ImageKit\Folders\FolderNewResponse;
use ImageKit\Folders\FolderRenameParams;
use ImageKit\Folders\FolderRenameResponse;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\FoldersContract;
use ImageKit\Services\Folders\JobService;

final class FoldersService implements FoldersContract
{
    /**
     * @api
     */
    public JobService $job;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->job = new JobService($client);
    }

    /**
     * @api
     *
     * This will create a new folder. You can specify the folder name and location of the parent folder where this new folder should be created.
     *
     * @param array{
     *   folderName: string, parentFolderPath: string
     * }|FolderCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|FolderCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderNewResponse {
        [$parsed, $options] = FolderCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/folder',
            body: (object) $parsed,
            options: $options,
            convert: FolderNewResponse::class,
        );
    }

    /**
     * @api
     *
     * This will delete a folder and all its contents permanently. The API returns an empty response.
     *
     * @param array{folderPath: string}|FolderDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        array|FolderDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderDeleteResponse {
        [$parsed, $options] = FolderDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: 'v1/folder',
            body: (object) $parsed,
            options: $options,
            convert: FolderDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * This will copy one folder into another. The selected folder, its nested folders, files, and their versions (in `includeVersions` is set to true) are copied in this operation. Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.
     *
     * @param array{
     *   destinationPath: string, sourceFolderPath: string, includeVersions?: bool
     * }|FolderCopyParams $params
     *
     * @throws APIException
     */
    public function copy(
        array|FolderCopyParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderCopyResponse {
        [$parsed, $options] = FolderCopyParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/bulkJobs/copyFolder',
            body: (object) $parsed,
            options: $options,
            convert: FolderCopyResponse::class,
        );
    }

    /**
     * @api
     *
     * This will move one folder into another. The selected folder, its nested folders, files, and their versions are moved in this operation. Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.
     *
     * @param array{
     *   destinationPath: string, sourceFolderPath: string
     * }|FolderMoveParams $params
     *
     * @throws APIException
     */
    public function move(
        array|FolderMoveParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderMoveResponse {
        [$parsed, $options] = FolderMoveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/bulkJobs/moveFolder',
            body: (object) $parsed,
            options: $options,
            convert: FolderMoveResponse::class,
        );
    }

    /**
     * @api
     *
     * This API allows you to rename an existing folder. The folder and all its nested assets and sub-folders will remain unchanged, but their paths will be updated to reflect the new folder name.
     *
     * @param array{
     *   folderPath: string, newFolderName: string, purgeCache?: bool
     * }|FolderRenameParams $params
     *
     * @throws APIException
     */
    public function rename(
        array|FolderRenameParams $params,
        ?RequestOptions $requestOptions = null
    ): FolderRenameResponse {
        [$parsed, $options] = FolderRenameParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/bulkJobs/renameFolder',
            body: (object) $parsed,
            options: $options,
            convert: FolderRenameResponse::class,
        );
    }
}
