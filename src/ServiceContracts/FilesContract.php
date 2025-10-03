<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\ExtensionItem\AIAutoDescription;
use ImageKit\ExtensionItem\AutoTaggingExtension;
use ImageKit\ExtensionItem\RemoveBg;
use ImageKit\Files\File;
use ImageKit\Files\FileCopyResponse;
use ImageKit\Files\FileMoveResponse;
use ImageKit\Files\FileRenameResponse;
use ImageKit\Files\FileUpdateParams\Publish;
use ImageKit\Files\FileUpdateResponse;
use ImageKit\Files\FileUploadParams\ResponseField;
use ImageKit\Files\FileUploadParams\Transformation;
use ImageKit\Files\FileUploadResponse;
use ImageKit\RequestOptions;

use const ImageKit\Core\OMIT as omit;

interface FilesContract
{
    /**
     * @api
     *
     * @param string|null $customCoordinates Define an important area in the image in the format `x,y,width,height` e.g. `10,10,100,100`. Send `null` to unset this value.
     * @param array<string,
     * mixed,> $customMetadata A key-value data to be associated with the asset. To unset a key, send `null` value for that key. Before setting any custom metadata on an asset you have to create the field using custom metadata fields API.
     * @param string $description optional text to describe the contents of the file
     * @param list<RemoveBg|AutoTaggingExtension|AIAutoDescription> $extensions Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     * @param string|list<string> $removeAITags An array of AITags associated with the file that you want to remove, e.g. `["car", "vehicle", "motorsports"]`.
     *
     * If you want to remove all AITags associated with the file, send a string - "all".
     *
     * Note: The remove operation for `AITags` executes before any of the `extensions` are processed.
     * @param list<string>|null $tags An array of tags associated with the file, such as `["tag1", "tag2"]`. Send `null` to unset all tags associated with the file.
     * @param string $webhookURL The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     * @param Publish $publish configure the publication status of a file and its versions
     *
     * @throws APIException
     */
    public function update(
        string $fileID,
        $customCoordinates = omit,
        $customMetadata = omit,
        $description = omit,
        $extensions = omit,
        $removeAITags = omit,
        $tags = omit,
        $webhookURL = omit,
        $publish = omit,
        ?RequestOptions $requestOptions = null,
    ): FileUpdateResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $fileID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): FileUpdateResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $destinationPath full path to the folder you want to copy the above file into
     * @param string $sourceFilePath the full path of the file you want to copy
     * @param bool $includeFileVersions Option to copy all versions of a file. By default, only the current version of the file is copied. When set to true, all versions of the file will be copied. Default value - `false`.
     *
     * @throws APIException
     */
    public function copy(
        $destinationPath,
        $sourceFilePath,
        $includeFileVersions = omit,
        ?RequestOptions $requestOptions = null,
    ): FileCopyResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function copyRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): FileCopyResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): File;

    /**
     * @api
     *
     * @param string $destinationPath full path to the folder you want to move the above file into
     * @param string $sourceFilePath the full path of the file you want to move
     *
     * @throws APIException
     */
    public function move(
        $destinationPath,
        $sourceFilePath,
        ?RequestOptions $requestOptions = null,
    ): FileMoveResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function moveRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): FileMoveResponse;

    /**
     * @api
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
     * @throws APIException
     */
    public function rename(
        $filePath,
        $newFileName,
        $purgeCache = omit,
        ?RequestOptions $requestOptions = null,
    ): FileRenameResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function renameRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): FileRenameResponse;

    /**
     * @api
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
     * @param list<RemoveBg|AutoTaggingExtension|AIAutoDescription> $extensions Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
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
     * @param list<ResponseField|value-of<ResponseField>> $responseFields array of response field keys to include in the API response body
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
     *
     * @throws APIException
     */
    public function upload(
        $file,
        $fileName,
        $token = omit,
        $checks = omit,
        $customCoordinates = omit,
        $customMetadata = omit,
        $description = omit,
        $expire = omit,
        $extensions = omit,
        $folder = omit,
        $isPrivateFile = omit,
        $isPublished = omit,
        $overwriteAITags = omit,
        $overwriteCustomMetadata = omit,
        $overwriteFile = omit,
        $overwriteTags = omit,
        $publicKey = omit,
        $responseFields = omit,
        $signature = omit,
        $tags = omit,
        $transformation = omit,
        $useUniqueFileName = omit,
        $webhookURL = omit,
        ?RequestOptions $requestOptions = null,
    ): FileUploadResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function uploadRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): FileUploadResponse;
}
