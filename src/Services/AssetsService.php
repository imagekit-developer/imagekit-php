<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Assets\AssetCopyResponse;
use ImageKit\Assets\AssetListParams\Sort;
use ImageKit\Assets\AssetMoveResponse;
use ImageKit\Assets\AssetRenameResponse;
use ImageKit\Assets\AssetUpdateParams\Publish;
use ImageKit\Assets\AssetUpdateResponse;
use ImageKit\Assets\AssetUploadParams\Overwrite;
use ImageKit\Assets\AssetUploadParams\Transformation;
use ImageKit\Assets\FileDetails;
use ImageKit\Assets\FileVersionDetails;
use ImageKit\Assets\FolderDetails;
use ImageKit\Assets\UploadResponse;
use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\FileParam;
use ImageKit\Core\Util;
use ImageKit\Cursor;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\AssetsContract;
use ImageKit\Services\Assets\BulkService;
use ImageKit\Services\Assets\FoldersService;
use ImageKit\Services\Assets\JobsService;
use ImageKit\Services\Assets\VersionsService;

/**
 * @phpstan-import-type PublishShape from \ImageKit\Assets\AssetUpdateParams\Publish
 * @phpstan-import-type RemoveAITagsShape from \ImageKit\Assets\AssetUpdateParams\RemoveAITags
 * @phpstan-import-type OverwriteShape from \ImageKit\Assets\AssetUploadParams\Overwrite
 * @phpstan-import-type TransformationShape from \ImageKit\Assets\AssetUploadParams\Transformation
 * @phpstan-import-type ExtensionItemShape from \ImageKit\ExtensionItem
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class AssetsService implements AssetsContract
{
    /**
     * @api
     */
    public AssetsRawService $raw;

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
    public FoldersService $folders;

    /**
     * @api
     */
    public JobsService $jobs;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AssetsRawService($client);
        $this->bulk = new BulkService($client);
        $this->versions = new VersionsService($client);
        $this->folders = new FoldersService($client);
        $this->jobs = new JobsService($client);
    }

    /**
     * @api
     *
     * Updates the details or attributes of the current version of a file. You can update `tags`, `custom_coordinates`, `custom_metadata`, publication status, remove existing `ai_tags`, and apply extensions using this API.
     *
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param string|null $customCoordinates Define an important area in the image in the format `x,y,width,height` e.g. `10,10,100,100`. Send `null` to unset this value.
     * @param array<string,mixed> $customMetadata A key-value data to be associated with the asset. To unset a key, send `null` value for that key. Before setting any custom metadata on an asset you have to create the field using custom metadata fields API.
     * @param string $description optional text to describe the contents of the file
     * @param list<ExtensionItemShape> $extensions Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     * @param Publish|PublishShape $publish configure the publication status of a file and its versions
     * @param RemoveAITagsShape $removeAITags An array of AI tags associated with the file that you want to remove, e.g. `["car", "vehicle", "motorsports"]`.
     *
     * If you want to remove all AI tags associated with the file, send the string `"all"`.
     *
     * Note: The remove operation for `ai_tags` executes before any of the `extensions` are processed.
     * @param list<string>|null $tags An array of tags associated with the file, such as `["tag1", "tag2"]`. Send `null` to unset all tags associated with the file.
     * @param string $webhookURL The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $assetID,
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?string $description = null,
        ?array $extensions = null,
        Publish|array|null $publish = null,
        string|array|null $removeAITags = null,
        ?array $tags = null,
        ?string $webhookURL = null,
        RequestOptions|array|null $requestOptions = null,
    ): AssetUpdateResponse {
        $params = Util::removeNulls(
            [
                'customCoordinates' => $customCoordinates,
                'customMetadata' => $customMetadata,
                'description' => $description,
                'extensions' => $extensions,
                'publish' => $publish,
                'removeAITags' => $removeAITags,
                'tags' => $tags,
                'webhookURL' => $webhookURL,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($assetID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API can list all the uploaded files and folders in your ImageKit.io media library. In addition, you can fine-tune your query by specifying various filters by generating a query string in a Lucene-like syntax and provide this generated string as the value of the `searchQuery`.
     *
     * @param string $cursor Opaque cursor returned in the `start_cursor` or `end_cursor` field of a previous response. Pass it to fetch the next (or previous) page of results. Omit to start from the beginning.
     * @param int $limit the maximum number of results to return in response
     * @param string $searchQuery Query string in a Lucene-like query language e.g. `createdAt > "7d"`.
     *
     * [Learn more](/docs/api-reference/digital-asset-management-dam/list-and-search-assets#advanced-search-queries) from examples.
     * @param Sort|value-of<Sort> $sort sort the results by one of the supported fields in ascending or descending order
     * @param RequestOpts|null $requestOptions
     *
     * @return Cursor<FileDetails|FileVersionDetails|FolderDetails>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        int $limit = 1000,
        ?string $searchQuery = null,
        Sort|string $sort = 'ASC_CREATED',
        RequestOptions|array|null $requestOptions = null,
    ): Cursor {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'limit' => $limit,
                'searchQuery' => $searchQuery,
                'sort' => $sort,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @throws APIException
     */
    public function delete(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($assetID, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param string $destinationPath full path of the destination folder
     * @param string $sourcePath full path of the file or folder you want to copy
     * @param bool $includeVersions When `true`, all versions of the source file(s) are copied. When `false` (default), only the current version is copied. Applies to both file and folder copy operations.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function copy(
        string $destinationPath,
        string $sourcePath,
        bool $includeVersions = false,
        RequestOptions|array|null $requestOptions = null,
    ): AssetCopyResponse {
        $params = Util::removeNulls(
            [
                'destinationPath' => $destinationPath,
                'sourcePath' => $sourcePath,
                'includeVersions' => $includeVersions,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->copy(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @throws APIException
     */
    public function get(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): FileDetails|FolderDetails {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get($assetID, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param string $destinationPath full path of the destination folder
     * @param string $sourcePath full path of the file or folder you want to move
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function move(
        string $destinationPath,
        string $sourcePath,
        RequestOptions|array|null $requestOptions = null,
    ): AssetMoveResponse {
        $params = Util::removeNulls(
            ['destinationPath' => $destinationPath, 'sourcePath' => $sourcePath]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->move(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param string $newName The new name of the file or folder. The name can contain:
     *
     * - Alphanumeric characters: `a-z`, `A-Z`, `0-9` (including Unicode letters, marks, and numerals in other languages).
     * - Special characters: `.`, `_`, and `-`.
     *
     * Any other character, including space, will be replaced by `_`.
     * @param string $path full path of the file or folder you want to rename
     * @param bool $purgeCache When `true`, ImageKit internally issues a purge cache request on the CDN to remove cached content of the old file (or, for folders, the nested files) and its versions. This purge request is counted against your monthly purge quota.
     *
     * Note: A purge cache request would be issued against `https://ik.imagekit.io/<imagekit_id>/<old-path>*` (with a trailing wildcard). It removes the file and its versions' URLs and any transformations made using query parameters. Transformations made using path parameters are not purged — use the purge API for those.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rename(
        string $newName,
        string $path,
        bool $purgeCache = false,
        RequestOptions|array|null $requestOptions = null,
    ): AssetRenameResponse {
        $params = Util::removeNulls(
            ['newName' => $newName, 'path' => $path, 'purgeCache' => $purgeCache]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->rename(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param string|FileParam $file The API accepts any of the following:
     *
     * - **Binary data** – send the raw bytes as `multipart/form-data`.
     * - **HTTP / HTTPS URL** – a publicly reachable URL that ImageKit’s servers can fetch.
     * - **Base64 string** – the file encoded as a Base64 data URI or plain Base64.
     *
     * When supplying a URL, the server must receive the response headers within 8 seconds; otherwise the request fails with 400 Bad Request.
     * @param string $fileName the name to use for the uploaded file
     * @param string $token This is the client-generated JSON Web Token (JWT). The ImageKit.io server uses it to authenticate and check that the upload request parameters have not been tampered with after the token has been generated. Learn how to create the token on the page below. This field is only required for authentication when uploading a file from the client side.
     * @param string $checks Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file-v2#upload-api-checks).
     * @param string $customCoordinates Define an important area in the image. This is only relevant for image type files.
     *
     *   - To be passed as a string with the x and y coordinates of the top-left corner, and width and height of the area of interest in the format `x,y,width,height`. For example - `10,10,100,100`
     *   - Can be used with fo-customtransformation.
     *   - If this field is not specified and the file is overwritten, then custom_coordinates will be removed.
     * @param array<string,mixed> $customMetadata JSON key-value pairs to associate with the asset. Create the custom metadata fields before setting these values.
     * @param string $description optional text to describe the contents of the file
     * @param list<ExtensionItemShape> $extensions Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     * @param string $folder The folder path in which the image has to be uploaded. If the folder(s) didn't exist before, a new folder(s) is created. Using multiple `/` creates a nested folder.
     * @param bool $isPrivateFile Whether to mark the file as private or not.
     *
     * If `true`, the file is marked as private and is accessible only using named transformation or signed URL.
     * @param bool $isPublished Whether to upload file as published or not.
     *
     * If `false`, the file is marked as unpublished, which restricts access to the file only via the media library. Files in draft or unpublished state can only be publicly accessed after being published.
     *
     * The option to upload in draft state is only available in custom enterprise pricing plans.
     * @param Overwrite|OverwriteShape $overwrite Controls what gets replaced when a file already exists at the same path. All fields default to `true`. Only relevant when `use_unique_file_name` is `false`.
     * @param list<string> $tags Set the tags while uploading the file.
     * Provide an array of tag strings (e.g. `["tag1", "tag2", "tag3"]`). The combined length of all tag characters must not exceed 500, and the `%` character is not allowed.
     * If this field is not specified and the file is overwritten, the existing tags will be removed.
     * @param Transformation|TransformationShape $transformation Configure pre-processing (`pre`) and post-processing (`post`) transformations.
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function upload(
        string|FileParam $file,
        string $fileName,
        ?string $token = null,
        ?string $checks = null,
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?string $description = null,
        ?array $extensions = null,
        string $folder = '/',
        bool $isPrivateFile = false,
        bool $isPublished = true,
        Overwrite|array|null $overwrite = null,
        ?array $tags = null,
        Transformation|array|null $transformation = null,
        bool $useUniqueFileName = true,
        RequestOptions|array|null $requestOptions = null,
    ): UploadResponse {
        $params = Util::removeNulls(
            [
                'file' => $file,
                'fileName' => $fileName,
                'token' => $token,
                'checks' => $checks,
                'customCoordinates' => $customCoordinates,
                'customMetadata' => $customMetadata,
                'description' => $description,
                'extensions' => $extensions,
                'folder' => $folder,
                'isPrivateFile' => $isPrivateFile,
                'isPublished' => $isPublished,
                'overwrite' => $overwrite,
                'tags' => $tags,
                'transformation' => $transformation,
                'useUniqueFileName' => $useUniqueFileName,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->upload(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
