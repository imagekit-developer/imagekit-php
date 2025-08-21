<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\Contracts\FilesContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Util;
use ImageKit\Files\FileCopyParams;
use ImageKit\Files\FileMoveParams;
use ImageKit\Files\FileRenameParams;
use ImageKit\Files\FileUpdateParams;
use ImageKit\Files\FileUpdateParams\Publish;
use ImageKit\Files\FileUpdateParams\RemoveAITags\UnionMember1;
use ImageKit\Files\FileUploadParams;
use ImageKit\Files\FileUploadParams\ResponseField;
use ImageKit\Files\FileUploadParams\Transformation;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\FileCopyResponse;
use ImageKit\Responses\Files\FileGetResponse;
use ImageKit\Responses\Files\FileMoveResponse;
use ImageKit\Responses\Files\FileRenameResponse;
use ImageKit\Responses\Files\FileUpdateResponse;
use ImageKit\Responses\Files\FileUploadResponse;
use ImageKit\Services\Files\BulkService;
use ImageKit\Services\Files\MetadataService;
use ImageKit\Services\Files\VersionsService;
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
     * @param null|string $customCoordinates Define an important area in the image in the format `x,y,width,height` e.g. `10,10,100,100`. Send `null` to unset this value.
     * @param array<string,
     * mixed,> $customMetadata A key-value data to be associated with the asset. To unset a key, send `null` value for that key. Before setting any custom metadata on an asset you have to create the field using custom metadata fields API.
     * @param string $description optional text to describe the contents of the file
     * @param list<AutoDescriptionExtension|AutoTaggingExtension|RemovedotBgExtension> $extensions Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     * @param list<string>|UnionMember1::* $removeAITags An array of AITags associated with the file that you want to remove, e.g. `["car", "vehicle", "motorsports"]`.
     *
     * If you want to remove all AITags associated with the file, send a string - "all".
     *
     * Note: The remove operation for `AITags` executes before any of the `extensions` are processed.
     * @param null|list<string> $tags An array of tags associated with the file, such as `["tag1", "tag2"]`. Send `null` to unset all tags associated with the file.
     * @param string $webhookURL The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     * @param Publish $publish configure the publication status of a file and its versions
     */
    public function update(
        string $fileID,
        $customCoordinates = null,
        $customMetadata = null,
        $description = null,
        $extensions = null,
        $removeAITags = null,
        $tags = null,
        $webhookURL = null,
        $publish = null,
        ?RequestOptions $requestOptions = null,
    ): FileUpdateResponse {
        $args = [
            'customCoordinates' => $customCoordinates,
            'customMetadata' => $customMetadata,
            'description' => $description,
            'extensions' => $extensions,
            'removeAITags' => $removeAITags,
            'tags' => $tags,
            'webhookURL' => $webhookURL,
            'publish' => $publish,
        ];
        $args = Util::array_filter_null(
            $args,
            [
                'customCoordinates',
                'customMetadata',
                'description',
                'extensions',
                'removeAITags',
                'tags',
                'webhookURL',
                'publish',
            ],
        );
        [$parsed, $options] = FileUpdateParams::parseRequest(
            $args,
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
     * @param string $destinationPath full path to the folder you want to copy the above file into
     * @param string $sourceFilePath the full path of the file you want to copy
     * @param bool $includeFileVersions Option to copy all versions of a file. By default, only the current version of the file is copied. When set to true, all versions of the file will be copied. Default value - `false`.
     */
    public function copy(
        $destinationPath,
        $sourceFilePath,
        $includeFileVersions = null,
        ?RequestOptions $requestOptions = null,
    ): FileCopyResponse {
        $args = [
            'destinationPath' => $destinationPath,
            'sourceFilePath' => $sourceFilePath,
            'includeFileVersions' => $includeFileVersions,
        ];
        $args = Util::array_filter_null($args, ['includeFileVersions']);
        [$parsed, $options] = FileCopyParams::parseRequest($args, $requestOptions);
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
     * @param string $destinationPath full path to the folder you want to move the above file into
     * @param string $sourceFilePath the full path of the file you want to move
     */
    public function move(
        $destinationPath,
        $sourceFilePath,
        ?RequestOptions $requestOptions = null
    ): FileMoveResponse {
        $args = [
            'destinationPath' => $destinationPath, 'sourceFilePath' => $sourceFilePath,
        ];
        [$parsed, $options] = FileMoveParams::parseRequest($args, $requestOptions);
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
     * @param string $filePath the full path of the file you want to rename
     * @param string $newFileName The new name of the file. A filename can contain:
     *
     * Alphanumeric Characters: `a-z`, `A-Z`, `0-9` (including Unicode letters, marks, and numerals in other languages).
     * Special Characters: `.`, `_`, and `-`.
     *
     * Any other character, including space, will be replaced by `_`.
     * @param bool $purgeCache Option to purge cache for the old file and its versions' URLs.
     *
     * When set to true, it will internally issue a purge cache request on CDN to remove cached content of old file and its versions. This purge request is counted against your monthly purge quota.
     *
     * Note: If the old file were accessible at `https://ik.imagekit.io/demo/old-filename.jpg`, a purge cache request would be issued against `https://ik.imagekit.io/demo/old-filename.jpg*` (with a wildcard at the end). It will remove the file and its versions' URLs and any transformations made using query parameters on this file or its versions. However, the cache for file transformations made using path parameters will persist. You can purge them using the purge API. For more details, refer to the purge API documentation.
     *
     * Default value - `false`
     */
    public function rename(
        $filePath,
        $newFileName,
        $purgeCache = null,
        ?RequestOptions $requestOptions = null,
    ): FileRenameResponse {
        $args = [
            'filePath' => $filePath,
            'newFileName' => $newFileName,
            'purgeCache' => $purgeCache,
        ];
        $args = Util::array_filter_null($args, ['purgeCache']);
        [$parsed, $options] = FileRenameParams::parseRequest(
            $args,
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
     * @param string $file The API accepts any of the following:
     *
     * - **Binary data** – send the raw bytes as `multipart/form-data`.
     * - **HTTP / HTTPS URL** – a publicly reachable URL that ImageKit’s servers can fetch.
     * - **Base64 string** – the file encoded as a Base64 data URI or plain Base64.
     *
     * When supplying a URL, the server must receive the response headers within 8 seconds; otherwise the request fails with 400 Bad Request.
     * @param string $fileName The name with which the file has to be uploaded.
     * The file name can contain:
     *
     *   - Alphanumeric Characters: `a-z`, `A-Z`, `0-9`.
     *   - Special Characters: `.`, `-`
     *
     * Any other character including space will be replaced by `_`
     * @param string $token A unique value that the ImageKit.io server will use to recognize and prevent subsequent retries for the same request. We suggest using V4 UUIDs, or another random string with enough entropy to avoid collisions. This field is only required for authentication when uploading a file from the client side.
     *
     * **Note**: Sending a value that has been used in the past will result in a validation error. Even if your previous request resulted in an error, you should always send a new value for this field.
     * @param string $checks Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file#upload-api-checks).
     * @param string $customCoordinates Define an important area in the image. This is only relevant for image type files.
     *
     *   - To be passed as a string with the x and y coordinates of the top-left corner, and width and height of the area of interest in the format `x,y,width,height`. For example - `10,10,100,100`
     *   - Can be used with fo-customtransformation.
     *   - If this field is not specified and the file is overwritten, then customCoordinates will be removed.
     * @param array<string,
     * mixed,> $customMetadata JSON key-value pairs to associate with the asset. Create the custom metadata fields before setting these values.
     * @param string $description optional text to describe the contents of the file
     * @param int $expire The time until your signature is valid. It must be a [Unix time](https://en.wikipedia.org/wiki/Unix_time) in less than 1 hour into the future. It should be in seconds. This field is only required for authentication when uploading a file from the client side.
     * @param list<AutoDescriptionExtension|AutoTaggingExtension|RemovedotBgExtension> $extensions Array of extensions to be applied to the image. Each extension can be configured with specific parameters based on the extension type.
     * @param string $folder The folder path in which the image has to be uploaded. If the folder(s) didn't exist before, a new folder(s) is created.
     *
     * The folder name can contain:
     *
     *   - Alphanumeric Characters: `a-z` , `A-Z` , `0-9`
     *   - Special Characters: `/` , `_` , `-`
     *
     * Using multiple `/` creates a nested folder.
     * @param bool $isPrivateFile Whether to mark the file as private or not.
     *
     * If `true`, the file is marked as private and is accessible only using named transformation or signed URL.
     * @param bool $isPublished Whether to upload file as published or not.
     *
     * If `false`, the file is marked as unpublished, which restricts access to the file only via the media library. Files in draft or unpublished state can only be publicly accessed after being published.
     *
     * The option to upload in draft state is only available in custom enterprise pricing plans.
     * @param bool $overwriteAITags If set to `true` and a file already exists at the exact location, its AITags will be removed. Set `overwriteAITags` to `false` to preserve AITags.
     * @param bool $overwriteCustomMetadata if the request does not have `customMetadata`, and a file already exists at the exact location, existing customMetadata will be removed
     * @param bool $overwriteFile if `false` and `useUniqueFileName` is also `false`, and a file already exists at the exact location, upload API will return an error immediately
     * @param bool $overwriteTags if the request does not have `tags`, and a file already exists at the exact location, existing tags will be removed
     * @param string $publicKey Your ImageKit.io public key. This field is only required for authentication when uploading a file from the client side.
     * @param list<ResponseField::*> $responseFields array of response field keys to include in the API response body
     * @param string $signature HMAC-SHA1 digest of the token+expire using your ImageKit.io private API key as a key. Learn how to create a signature on the page below. This should be in lowercase.
     *
     * Signature must be calculated on the server-side. This field is only required for authentication when uploading a file from the client side.
     * @param list<string> $tags Set the tags while uploading the file.
     * Provide an array of tag strings (e.g. `["tag1", "tag2", "tag3"]`). The combined length of all tag characters must not exceed 500, and the `%` character is not allowed.
     * If this field is not specified and the file is overwritten, the existing tags will be removed.
     * @param Transformation $transformation Configure pre-processing (`pre`) and post-processing (`post`) transformations.
     *
     * - `pre` — applied before the file is uploaded to the Media Library.
     *   Useful for reducing file size or applying basic optimizations upfront (e.g., resize, compress).
     *
     * - `post` — applied immediately after upload.
     *   Ideal for generating transformed versions (like video encodes or thumbnails) in advance, so they're ready for delivery without delay.
     *
     * You can mix and match any combination of post-processing types.
     * @param bool $useUniqueFileName Whether to use a unique filename for this file or not.
     *
     * If `true`, ImageKit.io will add a unique suffix to the filename parameter to get a unique filename.
     *
     * If `false`, then the image is uploaded with the provided filename parameter, and any existing file with the same name is replaced.
     * @param string $webhookURL The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     */
    public function upload(
        $file,
        $fileName,
        $token = null,
        $checks = null,
        $customCoordinates = null,
        $customMetadata = null,
        $description = null,
        $expire = null,
        $extensions = null,
        $folder = null,
        $isPrivateFile = null,
        $isPublished = null,
        $overwriteAITags = null,
        $overwriteCustomMetadata = null,
        $overwriteFile = null,
        $overwriteTags = null,
        $publicKey = null,
        $responseFields = null,
        $signature = null,
        $tags = null,
        $transformation = null,
        $useUniqueFileName = null,
        $webhookURL = null,
        ?RequestOptions $requestOptions = null,
    ): FileUploadResponse {
        $args = [
            'file' => $file,
            'fileName' => $fileName,
            'token' => $token,
            'checks' => $checks,
            'customCoordinates' => $customCoordinates,
            'customMetadata' => $customMetadata,
            'description' => $description,
            'expire' => $expire,
            'extensions' => $extensions,
            'folder' => $folder,
            'isPrivateFile' => $isPrivateFile,
            'isPublished' => $isPublished,
            'overwriteAITags' => $overwriteAITags,
            'overwriteCustomMetadata' => $overwriteCustomMetadata,
            'overwriteFile' => $overwriteFile,
            'overwriteTags' => $overwriteTags,
            'publicKey' => $publicKey,
            'responseFields' => $responseFields,
            'signature' => $signature,
            'tags' => $tags,
            'transformation' => $transformation,
            'useUniqueFileName' => $useUniqueFileName,
            'webhookURL' => $webhookURL,
        ];
        $args = Util::array_filter_null(
            $args,
            [
                'token',
                'checks',
                'customCoordinates',
                'customMetadata',
                'description',
                'expire',
                'extensions',
                'folder',
                'isPrivateFile',
                'isPublished',
                'overwriteAITags',
                'overwriteCustomMetadata',
                'overwriteFile',
                'overwriteTags',
                'publicKey',
                'responseFields',
                'signature',
                'tags',
                'transformation',
                'useUniqueFileName',
                'webhookURL',
            ],
        );
        [$parsed, $options] = FileUploadParams::parseRequest(
            $args,
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
