<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Assets\AssetCopyParams;
use ImageKit\Assets\AssetCopyResponse;
use ImageKit\Assets\AssetGetResponse;
use ImageKit\Assets\AssetListParams;
use ImageKit\Assets\AssetListParams\Sort;
use ImageKit\Assets\AssetListResponse;
use ImageKit\Assets\AssetMoveParams;
use ImageKit\Assets\AssetMoveResponse;
use ImageKit\Assets\AssetRenameParams;
use ImageKit\Assets\AssetRenameResponse;
use ImageKit\Assets\AssetUpdateParams;
use ImageKit\Assets\AssetUpdateParams\Publish;
use ImageKit\Assets\AssetUpdateResponse;
use ImageKit\Assets\AssetUploadParams;
use ImageKit\Assets\AssetUploadParams\Overwrite;
use ImageKit\Assets\AssetUploadParams\Transformation;
use ImageKit\Assets\FileDetails;
use ImageKit\Assets\FileVersionDetails;
use ImageKit\Assets\FolderDetails;
use ImageKit\Assets\UploadResponse;
use ImageKit\Client;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\FileParam;
use ImageKit\Cursor;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\AssetsRawContract;

/**
 * @phpstan-import-type PublishShape from \ImageKit\Assets\AssetUpdateParams\Publish
 * @phpstan-import-type RemoveAITagsShape from \ImageKit\Assets\AssetUpdateParams\RemoveAITags
 * @phpstan-import-type OverwriteShape from \ImageKit\Assets\AssetUploadParams\Overwrite
 * @phpstan-import-type TransformationShape from \ImageKit\Assets\AssetUploadParams\Transformation
 * @phpstan-import-type ExtensionItemShape from \ImageKit\ExtensionItem
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class AssetsRawService implements AssetsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Updates the details or attributes of the current version of a file. You can update `tags`, `custom_coordinates`, `custom_metadata`, publication status, remove existing `ai_tags`, and apply extensions using this API.
     *
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param array{
     *   customCoordinates?: string|null,
     *   customMetadata?: array<string,mixed>,
     *   description?: string,
     *   extensions?: list<ExtensionItemShape>,
     *   publish?: Publish|PublishShape,
     *   removeAITags?: RemoveAITagsShape,
     *   tags?: list<string>|null,
     *   webhookURL?: string,
     * }|AssetUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $assetID,
        array|AssetUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['v2/assets/%1$s', $assetID],
            body: (object) $parsed,
            options: $options,
            convert: AssetUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * This API can list all the uploaded files and folders in your ImageKit.io media library. In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
     *
     * @param array{
     *   cursor?: string, limit?: int, searchQuery?: string, sort?: value-of<Sort>
     * }|AssetListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Cursor<FileDetails|FileVersionDetails|FolderDetails>>
     *
     * @throws APIException
     */
    public function list(
        array|AssetListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v2/assets',
            query: $parsed,
            options: $options,
            convert: AssetListResponse::class,
            page: Cursor::class,
        );
    }

    /**
     * @api
     *
     * Deletes a file and all of its file versions permanently.
     *
     * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using the purge cache API.
     *
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v2/assets/%1$s', $assetID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Copies a file or a folder from one location to another. Pass a file path or a folder path in `source_path`.
     *
     * - **File copy** is synchronous and returns `204 No Content`.
     * - **Folder copy** is asynchronous — the selected folder along with its nested folders, files, and (optionally) file versions are copied in the background. The API returns `202 Accepted` with a `job_id`. Use the [get job status](#operation/get-job-status) API to track progress.
     *
     * Note: If a file at the destination has the same name as a source file, the source file (and its versions, when `include_versions` is `true`) will be appended to the destination file's version history.
     *
     * @param array{
     *   destinationPath: string, sourcePath: string, includeVersions?: bool
     * }|AssetCopyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetCopyResponse>
     *
     * @throws APIException
     */
    public function copy(
        array|AssetCopyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetCopyParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v2/assets/copy',
            body: (object) $parsed,
            options: $options,
            convert: AssetCopyResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns the details of a single asset — either a file or a folder — by its unique `asset_id`.
     * Use this endpoint to fetch metadata for any file or folder returned by the list and search assets API.
     *
     * @param string $assetID Unique identifier of the asset. Can be a `file` or `folder` id as returned by the list and search assets or upload APIs.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileDetails|FolderDetails>
     *
     * @throws APIException
     */
    public function get(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v2/assets/%1$s', $assetID],
            options: $requestOptions,
            convert: AssetGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Moves a file (and all its versions) or a folder (with all nested folders, files, and their versions) from one location to another. Pass a file path or a folder path in `source_path`.
     *
     * - **File move** is synchronous and returns `204 No Content`.
     * - **Folder move** is asynchronous — the API returns `202 Accepted` with a `job_id`. Use the [get job status](#operation/get-job-status) API to track progress.
     *
     * Note: If a file at the destination has the same name as a source file, the source file and its versions will be appended to the destination file.
     *
     * @param array{
     *   destinationPath: string, sourcePath: string
     * }|AssetMoveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetMoveResponse>
     *
     * @throws APIException
     */
    public function move(
        array|AssetMoveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetMoveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v2/assets/move',
            body: (object) $parsed,
            options: $options,
            convert: AssetMoveResponse::class,
        );
    }

    /**
     * @api
     *
     * Renames an existing file or folder in the media library. Pass a file path or a folder path in `path`.
     *
     * - **File rename** is synchronous. The operation renames all file versions of the file and returns `200 OK`. If `purge_cache` was `true`, the response includes `purge_request_id`; if the purge quota is exhausted, `207 Multi-Status` is returned (the rename succeeded, the purge did not).
     * - **Folder rename** is asynchronous. The folder and all its nested assets and sub-folders remain unchanged, but their paths are updated to reflect the new folder name. The API returns `202 Accepted` with a `job_id`. Use the [get job status](#operation/get-job-status) API to track progress.
     *
     * Note: The old URLs will stop working. The file or file version URLs cached on the CDN will continue to work until a purge is requested — either implicitly via `purge_cache` or explicitly via the purge cache API.
     *
     * @param array{
     *   newName: string, path: string, purgeCache?: bool
     * }|AssetRenameParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetRenameResponse>
     *
     * @throws APIException
     */
    public function rename(
        array|AssetRenameParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetRenameParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: 'v2/assets/rename',
            body: (object) $parsed,
            options: $options,
            convert: AssetRenameResponse::class,
        );
    }

    /**
     * @api
     *
     * ImageKit.io allows you to upload files directly from both the server and client sides. For server-side uploads, private API key authentication is used. For client-side uploads, generate a one-time `token` from your secure backend using private API. [Learn more](/docs/api-reference/upload-file/upload-file-v2#how-to-implement-secure-client-side-file-upload) about how to implement secure client-side file upload.
     *
     * **File size limit** \
     * On the free plan, the maximum upload file sizes are 25MB for images, audio, and raw files, and 100MB for videos. On the Lite paid plan, these limits increase to 40MB for images, audio, and raw files and 300MB for videos, whereas on the Pro paid plan, these limits increase to 50MB for images, audio, and raw files and 2GB for videos. These limits can be further increased with enterprise plans.
     *
     * **Version limit** \
     * A file can have a maximum of 100 versions.
     *
     * **Demo applications**
     *
     * - A full-fledged [upload widget using Uppy](https://github.com/imagekit-samples/uppy-uploader), supporting file selections from local storage, URL, Dropbox, Google Drive, Instagram, and more.
     * - [Quick start guides](/docs/quick-start-guides) for various frameworks and technologies.
     *
     * @param array{
     *   file: string|FileParam,
     *   fileName: string,
     *   token?: string,
     *   checks?: string,
     *   customCoordinates?: string,
     *   customMetadata?: array<string,mixed>,
     *   description?: string,
     *   extensions?: list<ExtensionItemShape>,
     *   folder?: string,
     *   isPrivateFile?: bool,
     *   isPublished?: bool,
     *   overwrite?: Overwrite|OverwriteShape,
     *   tags?: list<string>,
     *   transformation?: Transformation|TransformationShape,
     *   useUniqueFileName?: bool,
     * }|AssetUploadParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        array|AssetUploadParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetUploadParams::parseRequest(
            $params,
            $requestOptions,
        );
        $path = $this
            ->client
            ->baseUrlOverridden ? 'v2/assets/upload' : 'https://upload.imagekit.io/v2/assets/upload';

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: $path,
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
            convert: UploadResponse::class,
        );
    }
}
