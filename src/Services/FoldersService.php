<?php

declare(strict_types=1);

namespace Imagekit\Services;

use Imagekit\Client;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Folders\FolderCopyParams;
use Imagekit\Folders\FolderCopyResponse;
use Imagekit\Folders\FolderCreateParams;
use Imagekit\Folders\FolderDeleteParams;
use Imagekit\Folders\FolderDeleteResponse;
use Imagekit\Folders\FolderMoveParams;
use Imagekit\Folders\FolderMoveResponse;
use Imagekit\Folders\FolderNewResponse;
use Imagekit\Folders\FolderRenameParams;
use Imagekit\Folders\FolderRenameResponse;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\FoldersContract;
use Imagekit\Services\Folders\JobService;

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

        /** @var BaseResponse<FolderNewResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'v1/folder',
            body: (object) $parsed,
            options: $options,
            convert: FolderNewResponse::class,
        );

        return $response->parse();
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

        /** @var BaseResponse<FolderDeleteResponse> */
        $response = $this->client->request(
            method: 'delete',
            path: 'v1/folder',
            body: (object) $parsed,
            options: $options,
            convert: FolderDeleteResponse::class,
        );

        return $response->parse();
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

        /** @var BaseResponse<FolderCopyResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'v1/bulkJobs/copyFolder',
            body: (object) $parsed,
            options: $options,
            convert: FolderCopyResponse::class,
        );

        return $response->parse();
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

        /** @var BaseResponse<FolderMoveResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'v1/bulkJobs/moveFolder',
            body: (object) $parsed,
            options: $options,
            convert: FolderMoveResponse::class,
        );

        return $response->parse();
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

        /** @var BaseResponse<FolderRenameResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'v1/bulkJobs/renameFolder',
            body: (object) $parsed,
            options: $options,
            convert: FolderRenameResponse::class,
        );

        return $response->parse();
    }
}
