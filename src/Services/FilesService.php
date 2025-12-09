<?php

declare(strict_types=1);

namespace Imagekit\Services;

use Imagekit\Client;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\File;
use Imagekit\Files\FileCopyParams;
use Imagekit\Files\FileCopyResponse;
use Imagekit\Files\FileMoveParams;
use Imagekit\Files\FileMoveResponse;
use Imagekit\Files\FileRenameParams;
use Imagekit\Files\FileRenameResponse;
use Imagekit\Files\FileUpdateParams;
use Imagekit\Files\FileUpdateResponse;
use Imagekit\Files\FileUploadParams;
use Imagekit\Files\FileUploadParams\ResponseField;
use Imagekit\Files\FileUploadResponse;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\FilesContract;
use Imagekit\Services\Files\BulkService;
use Imagekit\Services\Files\MetadataService;
use Imagekit\Services\Files\VersionsService;

final class FilesService implements FilesContract
{
    /**
     * @api
     */
    public BulkService $bulk;

    /**
     * @api
     */
    public VersionsService $versions;

    /**
     * @api
     */
    public MetadataService $metadata;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->bulk = new BulkService($client);
        $this->versions = new VersionsService($client);
        $this->metadata = new MetadataService($client);
    }

    /**
     * @api
     *
     * This API updates the details or attributes of the current version of the file. You can update `tags`, `customCoordinates`, `customMetadata`, publication status, remove existing `AITags` and apply extensions using this API.
     *
     * @throws APIException
     */
    public function update(
        string $fileID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): FileUpdateResponse {
        [$parsed, $options] = FileUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<FileUpdateResponse> */
        $response = $this->client->request(
            method: 'patch',
            path: ['v1/files/%1$s/details', $fileID],
            body: (object) $parsed,
            options: $options,
            convert: FileUpdateResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * This API deletes the file and all its file versions permanently.
     *
     * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using purge cache API.
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'delete',
            path: ['v1/files/%1$s', $fileID],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * This will copy a file from one folder to another.
     *
     * Note: If any file at the destination has the same name as the source file, then the source file and its versions (if `includeFileVersions` is set to true) will be appended to the destination file version history.
     *
     * @param array{
     *   destinationPath: string, sourceFilePath: string, includeFileVersions?: bool
     * }|FileCopyParams $params
     *
     * @throws APIException
     */
    public function copy(
        array|FileCopyParams $params,
        ?RequestOptions $requestOptions = null
    ): FileCopyResponse {
        [$parsed, $options] = FileCopyParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<FileCopyResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'v1/files/copy',
            body: (object) $parsed,
            options: $options,
            convert: FileCopyResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * This API returns an object with details or attributes about the current version of the file.
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): File {
        /** @var BaseResponse<File> */
        $response = $this->client->request(
            method: 'get',
            path: ['v1/files/%1$s/details', $fileID],
            options: $requestOptions,
            convert: File::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * This will move a file and all its versions from one folder to another.
     *
     * Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file.
     *
     * @param array{
     *   destinationPath: string, sourceFilePath: string
     * }|FileMoveParams $params
     *
     * @throws APIException
     */
    public function move(
        array|FileMoveParams $params,
        ?RequestOptions $requestOptions = null
    ): FileMoveResponse {
        [$parsed, $options] = FileMoveParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<FileMoveResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'v1/files/move',
            body: (object) $parsed,
            options: $options,
            convert: FileMoveResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * You can rename an already existing file in the media library using rename file API. This operation would rename all file versions of the file.
     *
     * Note: The old URLs will stop working. The file/file version URLs cached on CDN will continue to work unless a purge is requested.
     *
     * @param array{
     *   filePath: string, newFileName: string, purgeCache?: bool
     * }|FileRenameParams $params
     *
     * @throws APIException
     */
    public function rename(
        array|FileRenameParams $params,
        ?RequestOptions $requestOptions = null
    ): FileRenameResponse {
        [$parsed, $options] = FileRenameParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<FileRenameResponse> */
        $response = $this->client->request(
            method: 'put',
            path: 'v1/files/rename',
            body: (object) $parsed,
            options: $options,
            convert: FileRenameResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * ImageKit.io allows you to upload files directly from both the server and client sides. For server-side uploads, private API key authentication is used. For client-side uploads, generate a one-time `token`, `signature`, and `expire` from your secure backend using private API. [Learn more](/docs/api-reference/upload-file/upload-file#how-to-implement-client-side-file-upload) about how to implement client-side file upload.
     *
     * The [V2 API](/docs/api-reference/upload-file/upload-file-v2) enhances security by verifying the entire payload using JWT.
     *
     * **File size limit** \
     * On the free plan, the maximum upload file sizes are 20MB for images, audio, and raw files and 100MB for videos. On the paid plan, these limits increase to 40MB for images, audio, and raw files and 2GB for videos. These limits can be further increased with higher-tier plans.
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
     *   file: string,
     *   fileName: string,
     *   token?: string,
     *   checks?: string,
     *   customCoordinates?: string,
     *   customMetadata?: array<string,mixed>,
     *   description?: string,
     *   expire?: int,
     *   extensions?: list<array<string,mixed>>,
     *   folder?: string,
     *   isPrivateFile?: bool,
     *   isPublished?: bool,
     *   overwriteAITags?: bool,
     *   overwriteCustomMetadata?: bool,
     *   overwriteFile?: bool,
     *   overwriteTags?: bool,
     *   publicKey?: string,
     *   responseFields?: list<'tags'|'customCoordinates'|'isPrivateFile'|'embeddedMetadata'|'isPublished'|'customMetadata'|'metadata'|'selectedFieldsSchema'|ResponseField>,
     *   signature?: string,
     *   tags?: list<string>,
     *   transformation?: array{post?: list<array<string,mixed>>, pre?: string},
     *   useUniqueFileName?: bool,
     *   webhookUrl?: string,
     * }|FileUploadParams $params
     *
     * @throws APIException
     */
    public function upload(
        array|FileUploadParams $params,
        ?RequestOptions $requestOptions = null
    ): FileUploadResponse {
        [$parsed, $options] = FileUploadParams::parseRequest(
            $params,
            $requestOptions,
        );
        $path = $this
            ->client
            ->baseUrlOverridden ? 'api/v1/files/upload' : 'https://upload.imagekit.io/api/v1/files/upload';

        /** @var BaseResponse<FileUploadResponse> */
        $response = $this->client->request(
            method: 'post',
            path: $path,
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
            convert: FileUploadResponse::class,
        );

        return $response->parse();
    }
}
