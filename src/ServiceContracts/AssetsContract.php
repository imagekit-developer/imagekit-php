<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts;

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
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\FileParam;
use ImageKit\Cursor;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type PublishShape from \ImageKit\Assets\AssetUpdateParams\Publish
 * @phpstan-import-type RemoveAITagsShape from \ImageKit\Assets\AssetUpdateParams\RemoveAITags
 * @phpstan-import-type OverwriteShape from \ImageKit\Assets\AssetUploadParams\Overwrite
 * @phpstan-import-type TransformationShape from \ImageKit\Assets\AssetUploadParams\Transformation
 * @phpstan-import-type ExtensionItemShape from \ImageKit\ExtensionItem
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface AssetsContract
{
    /**
     * @api
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
        RequestOptions|array|null $requestOptions = null,
    ): AssetUpdateResponse;

    /**
     * @api
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
    ): Cursor;

    /**
     * @api
     *
     * @param string $assetID Unique identifier of the file. Returned by the list and search assets API and the upload API.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): AssetCopyResponse;

    /**
     * @api
     *
     * @param string $assetID Unique identifier of the asset. Can be a `file` or `folder` id as returned by the list and search assets or upload APIs.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): FileDetails|FolderDetails;

    /**
     * @api
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
    ): AssetMoveResponse;

    /**
     * @api
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
    ): AssetRenameResponse;

    /**
     * @api
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
    ): UploadResponse;
}
