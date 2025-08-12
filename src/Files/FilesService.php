<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Client;
use ImageKit\Contracts\FilesContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Files\Batch\BatchService;
use ImageKit\Files\Details\DetailsService;
use ImageKit\Files\FileListParams\Type;
use ImageKit\Files\FileUploadV1Params\IsPrivateFile;
use ImageKit\Files\FileUploadV1Params\IsPublished;
use ImageKit\Files\FileUploadV1Params\OverwriteAITags;
use ImageKit\Files\FileUploadV1Params\OverwriteCustomMetadata;
use ImageKit\Files\FileUploadV1Params\OverwriteTags;
use ImageKit\Files\FileUploadV1Params\UseUniqueFileName;
use ImageKit\Files\FileUploadV2Params\IsPrivateFile as IsPrivateFile1;
use ImageKit\Files\FileUploadV2Params\IsPublished as IsPublished1;
use ImageKit\Files\FileUploadV2Params\OverwriteAITags as OverwriteAITags1;
use ImageKit\Files\FileUploadV2Params\OverwriteCustomMetadata as OverwriteCustomMetadata1;
use ImageKit\Files\FileUploadV2Params\OverwriteTags as OverwriteTags1;
use ImageKit\Files\FileUploadV2Params\UseUniqueFileName as UseUniqueFileName1;
use ImageKit\Files\Metadata\MetadataService;
use ImageKit\Files\Purge\PurgeService;
use ImageKit\Files\Versions\VersionsService;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\FileAddTagsResponse;
use ImageKit\Responses\Files\FileListResponseItem;
use ImageKit\Responses\Files\FileRemoveAITagsResponse;
use ImageKit\Responses\Files\FileRemoveTagsResponse;
use ImageKit\Responses\Files\FileRenameResponse;
use ImageKit\Responses\Files\FileUploadV1Response;
use ImageKit\Responses\Files\FileUploadV2Response;

final class FilesService implements FilesContract
{
    public DetailsService $details;

    public BatchService $batch;

    public VersionsService $versions;

    public PurgeService $purge;

    public MetadataService $metadata;

    public function __construct(private Client $client)
    {
        $this->details = new DetailsService($this->client);
        $this->batch = new BatchService($this->client);
        $this->versions = new VersionsService($this->client);
        $this->purge = new PurgeService($this->client);
        $this->metadata = new MetadataService($this->client);
    }

    /**
     * This API can list all the uploaded files and folders in your ImageKit.io media library. In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
     *
     * @param array{
     *   fileType?: string,
     *   limit?: string,
     *   path?: string,
     *   searchQuery?: string,
     *   skip?: string,
     *   sort?: string,
     *   type?: Type::*,
     * }|FileListParams $params
     *
     * @return list<FileListResponseItem>
     */
    public function list(
        array|FileListParams $params,
        ?RequestOptions $requestOptions = null
    ): array {
        [$parsed, $options] = FileListParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'v1/files',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            new ListOf(FileListResponseItem::class),
            value: $resp
        );
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
     * This API adds tags to multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param array{
     *   fileIDs: list<string>, tags: list<string>
     * }|FileAddTagsParams $params
     */
    public function addTags(
        array|FileAddTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): FileAddTagsResponse {
        [$parsed, $options] = FileAddTagsParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/addTags',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FileAddTagsResponse::class, value: $resp);
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
    ): mixed {
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
        return Conversion::coerce('mixed', value: $resp);
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
    ): mixed {
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
        return Conversion::coerce('mixed', value: $resp);
    }

    /**
     * This API removes AITags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param array{
     *   aiTags: list<string>, fileIDs: list<string>
     * }|FileRemoveAITagsParams $params
     */
    public function removeAITags(
        array|FileRemoveAITagsParams $params,
        ?RequestOptions $requestOptions = null
    ): FileRemoveAITagsResponse {
        [$parsed, $options] = FileRemoveAITagsParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/removeAITags',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FileRemoveAITagsResponse::class, value: $resp);
    }

    /**
     * This API removes tags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param array{
     *   fileIDs: list<string>, tags: list<string>
     * }|FileRemoveTagsParams $params
     */
    public function removeTags(
        array|FileRemoveTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): FileRemoveTagsResponse {
        [$parsed, $options] = FileRemoveTagsParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/removeTags',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FileRemoveTagsResponse::class, value: $resp);
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
     *   customMetadata?: string,
     *   expire?: string,
     *   extensions?: string,
     *   folder?: string,
     *   isPrivateFile?: IsPrivateFile::*,
     *   isPublished?: IsPublished::*,
     *   overwriteAITags?: OverwriteAITags::*,
     *   overwriteCustomMetadata?: OverwriteCustomMetadata::*,
     *   overwriteFile?: string,
     *   overwriteTags?: OverwriteTags::*,
     *   publicKey?: string,
     *   responseFields?: string,
     *   signature?: string,
     *   tags?: string,
     *   transformation?: string,
     *   useUniqueFileName?: UseUniqueFileName::*,
     *   webhookURL?: string,
     * }|FileUploadV1Params $params
     */
    public function uploadV1(
        array|FileUploadV1Params $params,
        ?RequestOptions $requestOptions = null
    ): FileUploadV1Response {
        [$parsed, $options] = FileUploadV1Params::parseRequest(
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
        return Conversion::coerce(FileUploadV1Response::class, value: $resp);
    }

    /**
     * The V2 API enhances security by verifying the entire payload using JWT. This API is in beta.
     *
     * ImageKit.io allows you to upload files directly from both the server and client sides. For server-side uploads, private API key authentication is used. For client-side uploads, generate a one-time `token` from your secure backend using private API. [Learn more](/docs/api-reference/upload-file/upload-file-v2#how-to-implement-secure-client-side-file-upload) about how to implement secure client-side file upload.
     *
     * **File size limit** \
     * On the free plan, the maximum upload file sizes are 20MB for images, audio, and raw files, and 100MB for videos. On the paid plan, these limits increase to 40MB for images, audio, and raw files, and 2GB for videos. These limits can be further increased with higher-tier plans.
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
     *   customMetadata?: string,
     *   extensions?: string,
     *   folder?: string,
     *   isPrivateFile?: IsPrivateFile1::*,
     *   isPublished?: IsPublished1::*,
     *   overwriteAITags?: OverwriteAITags1::*,
     *   overwriteCustomMetadata?: OverwriteCustomMetadata1::*,
     *   overwriteFile?: string,
     *   overwriteTags?: OverwriteTags1::*,
     *   responseFields?: string,
     *   tags?: string,
     *   transformation?: string,
     *   useUniqueFileName?: UseUniqueFileName1::*,
     *   webhookURL?: string,
     * }|FileUploadV2Params $params
     */
    public function uploadV2(
        array|FileUploadV2Params $params,
        ?RequestOptions $requestOptions = null
    ): FileUploadV2Response {
        [$parsed, $options] = FileUploadV2Params::parseRequest(
            $params,
            $requestOptions
        );
        $path = $this
            ->client
            ->baseUrlOverridden ? 'api/v2/files/upload' : 'https://upload.imagekit.io/api/v2/files/upload';
        $resp = $this->client->request(
            method: 'post',
            path: $path,
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(FileUploadV2Response::class, value: $resp);
    }
}
