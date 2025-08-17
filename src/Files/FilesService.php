<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Client;
use ImageKit\Contracts\FilesContract;
use ImageKit\Core\Conversion;
use ImageKit\Files\Bulk\BulkService;
use ImageKit\Files\FileUpdateParams\Publish;
use ImageKit\Files\FileUpdateParams\RemoveAITags\UnionMember1;
use ImageKit\Files\FileUploadParams\ResponseField;
use ImageKit\Files\FileUploadParams\Transformation;
use ImageKit\Files\Metadata\MetadataService;
use ImageKit\Files\Versions\VersionsService;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\FileCopyResponse;
use ImageKit\Responses\Files\FileGetResponse;
use ImageKit\Responses\Files\FileMoveResponse;
use ImageKit\Responses\Files\FileRenameResponse;
use ImageKit\Responses\Files\FileUpdateResponse;
use ImageKit\Responses\Files\FileUploadResponse;
use ImageKit\Shared\AutoDescriptionExtension;
use ImageKit\Shared\AutoTaggingExtension;
use ImageKit\Shared\RemovedotBgExtension;

final class FilesService implements FilesContract
{
    public BulkService $bulk;

    public VersionsService $versions;

    public MetadataService $metadata;

    public function __construct(private Client $client)
    {
        $this->bulk = new BulkService($this->client);
        $this->versions = new VersionsService($this->client);
        $this->metadata = new MetadataService($this->client);
    }

    /**
     * This API updates the details or attributes of the current version of the file. You can update `tags`, `customCoordinates`, `customMetadata`, publication status, remove existing `AITags` and apply extensions using this API.
     *
     * @param array{
     *   customCoordinates?: null|string,
     *   customMetadata?: array<string, mixed>,
     *   description?: string,
     *   extensions?: list<AutoDescriptionExtension|AutoTaggingExtension|RemovedotBgExtension>,
     *   removeAITags?: list<string>|UnionMember1::*,
     *   tags?: null|list<string>,
     *   webhookURL?: string,
     *   publish?: Publish,
     * }|FileUpdateParams $params
     */
    public function update(
        string $fileID,
        array|FileUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): FileUpdateResponse {
        [$parsed, $options] = FileUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'patch',
            path: ['v1/files/%1$s/details', $fileID],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FileUpdateResponse::class, value: $resp);
    }

    /**
     * This API deletes the file and all its file versions permanently.
     *
     * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using purge cache API.
     */
    public function delete(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        return $this->client->request(
            method: 'delete',
            path: ['v1/files/%1$s', $fileID],
            options: $requestOptions,
        );
    }

    /**
     * This will copy a file from one folder to another.
     *
     * Note: If any file at the destination has the same name as the source file, then the source file and its versions (if `includeFileVersions` is set to true) will be appended to the destination file version history.
     *
     * @param array{
     *   destinationPath: string, sourceFilePath: string, includeFileVersions?: bool
     * }|FileCopyParams $params
     */
    public function copy(
        array|FileCopyParams $params,
        ?RequestOptions $requestOptions = null
    ): FileCopyResponse {
        [$parsed, $options] = FileCopyParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/copy',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FileCopyResponse::class, value: $resp);
    }

    /**
     * This API returns an object with details or attributes about the current version of the file.
     */
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): FileGetResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/files/%1$s/details', $fileID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FileGetResponse::class, value: $resp);
    }

    /**
     * This will move a file and all its versions from one folder to another.
     *
     * Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file.
     *
     * @param array{
     *   destinationPath: string, sourceFilePath: string
     * }|FileMoveParams $params
     */
    public function move(
        array|FileMoveParams $params,
        ?RequestOptions $requestOptions = null
    ): FileMoveResponse {
        [$parsed, $options] = FileMoveParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/move',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FileMoveResponse::class, value: $resp);
    }

    /**
     * You can rename an already existing file in the media library using rename file API. This operation would rename all file versions of the file.
     *
     * Note: The old URLs will stop working. The file/file version URLs cached on CDN will continue to work unless a purge is requested.
     *
     * @param array{
     *   filePath: string, newFileName: string, purgeCache?: bool
     * }|FileRenameParams $params
     */
    public function rename(
        array|FileRenameParams $params,
        ?RequestOptions $requestOptions = null
    ): FileRenameResponse {
        [$parsed, $options] = FileRenameParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'put',
            path: 'v1/files/rename',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FileRenameResponse::class, value: $resp);
    }

    /**
     * ImageKit.io allows you to upload files directly from both the server and client sides. For server-side uploads, private API key authentication is used. For client-side uploads, generate a one-time `token`, `signature`, and `expiration` from your secure backend using private API. [Learn more](/docs/api-reference/upload-file/upload-file#how-to-implement-client-side-file-upload) about how to implement client-side file upload.
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
     *   customMetadata?: array<string, mixed>,
     *   description?: string,
     *   expire?: int,
     *   extensions?: list<AutoDescriptionExtension|AutoTaggingExtension|RemovedotBgExtension>,
     *   folder?: string,
     *   isPrivateFile?: bool,
     *   isPublished?: bool,
     *   overwriteAITags?: bool,
     *   overwriteCustomMetadata?: bool,
     *   overwriteFile?: bool,
     *   overwriteTags?: bool,
     *   publicKey?: string,
     *   responseFields?: list<ResponseField::*>,
     *   signature?: string,
     *   tags?: list<string>,
     *   transformation?: Transformation,
     *   useUniqueFileName?: bool,
     *   webhookURL?: string,
     * }|FileUploadParams $params
     */
    public function upload(
        array|FileUploadParams $params,
        ?RequestOptions $requestOptions = null
    ): FileUploadResponse {
        [$parsed, $options] = FileUploadParams::parseRequest(
            $params,
            $requestOptions
        );
        $path = $this
            ->client
            ->baseUrlOverridden ? 'api/v1/files/upload' : 'https://upload.imagekit.io/api/v1/files/upload';
        $resp = $this->client->request(
            method: 'post',
            path: $path,
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FileUploadResponse::class, value: $resp);
    }
}
