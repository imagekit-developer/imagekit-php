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
use Imagekit\ServiceContracts\FoldersRawContract;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
final class FoldersRawService implements FoldersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This will create a new folder. You can specify the folder name and location of the parent folder where this new folder should be created.
     *
     * @param array{
     *   folderName: string, parentFolderPath: string
     * }|FolderCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|FolderCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        array|FolderDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderCopyResponse>
     *
     * @throws APIException
     */
    public function copy(
        array|FolderCopyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderMoveResponse>
     *
     * @throws APIException
     */
    public function move(
        array|FolderMoveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderRenameResponse>
     *
     * @throws APIException
     */
    public function rename(
        array|FolderRenameParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
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
