<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files;

use ImageKit\Beta\V2\Files\FileUploadParams\Extension\AutoDescriptionExtension;
use ImageKit\Beta\V2\Files\FileUploadParams\Extension\AutoTaggingExtension;
use ImageKit\Beta\V2\Files\FileUploadParams\Extension\RemovedotBgExtension;
use ImageKit\Beta\V2\Files\FileUploadParams\ResponseField;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation;
use ImageKit\Client;
use ImageKit\Contracts\Beta\V2\FilesContract;
use ImageKit\Core\Conversion;
use ImageKit\RequestOptions;
use ImageKit\Responses\Beta\V2\Files\FileUploadResponse;

final class FilesService implements FilesContract
{
    public function __construct(private Client $client) {}

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
     *   customMetadata?: array<string, mixed>,
     *   description?: string,
     *   extensions?: list<AutoDescriptionExtension|AutoTaggingExtension|RemovedotBgExtension>,
     *   folder?: string,
     *   isPrivateFile?: bool,
     *   isPublished?: bool,
     *   overwriteAITags?: bool,
     *   overwriteCustomMetadata?: bool,
     *   overwriteFile?: bool,
     *   overwriteTags?: bool,
     *   responseFields?: list<ResponseField::*>,
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
            ->baseUrlOverridden ? 'api/v2/files/upload' : 'https://upload.imagekit.io/api/v2/files/upload';
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
