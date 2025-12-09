<?php

declare(strict_types=1);

namespace Imagekit\Services\Beta\V2;

use Imagekit\Beta\V2\Files\FileUploadParams\ResponseField;
use Imagekit\Beta\V2\Files\FileUploadResponse;
use Imagekit\Client;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Beta\V2\FilesContract;

final class FilesService implements FilesContract
{
    /**
     * @api
     */
    public FilesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FilesRawService($client);
    }

    /**
     * @api
     *
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
     * @param string $file The API accepts any of the following:
     *
     * - **Binary data** – send the raw bytes as `multipart/form-data`.
     * - **HTTP / HTTPS URL** – a publicly reachable URL that ImageKit’s servers can fetch.
     * - **Base64 string** – the file encoded as a Base64 data URI or plain Base64.
     *
     * When supplying a URL, the server must receive the response headers within 8 seconds; otherwise the request fails with 400 Bad Request.
     * @param string $fileName the name with which the file has to be uploaded
     * @param string $token This is the client-generated JSON Web Token (JWT). The ImageKit.io server uses it to authenticate and check that the upload request parameters have not been tampered with after the token has been generated. Learn how to create the token on the page below. This field is only required for authentication when uploading a file from the client side.
     * @param string $checks Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file-v2#upload-api-checks).
     * @param string $customCoordinates Define an important area in the image. This is only relevant for image type files.
     *
     *   - To be passed as a string with the x and y coordinates of the top-left corner, and width and height of the area of interest in the format `x,y,width,height`. For example - `10,10,100,100`
     *   - Can be used with fo-customtransformation.
     *   - If this field is not specified and the file is overwritten, then customCoordinates will be removed.
     * @param array<string,mixed> $customMetadata JSON key-value pairs to associate with the asset. Create the custom metadata fields before setting these values.
     * @param string $description optional text to describe the contents of the file
     * @param list<array<string,mixed>> $extensions Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     * @param string $folder The folder path in which the image has to be uploaded. If the folder(s) didn't exist before, a new folder(s) is created. Using multiple `/` creates a nested folder.
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
     * @param list<'tags'|'customCoordinates'|'isPrivateFile'|'embeddedMetadata'|'isPublished'|'customMetadata'|'metadata'|'selectedFieldsSchema'|ResponseField> $responseFields array of response field keys to include in the API response body
     * @param list<string> $tags Set the tags while uploading the file.
     * Provide an array of tag strings (e.g. `["tag1", "tag2", "tag3"]`). The combined length of all tag characters must not exceed 500, and the `%` character is not allowed.
     * If this field is not specified and the file is overwritten, the existing tags will be removed.
     * @param array{
     *   post?: list<array<string,mixed>>, pre?: string
     * } $transformation Configure pre-processing (`pre`) and post-processing (`post`) transformations.
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
        string $file,
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
        bool $overwriteAITags = true,
        bool $overwriteCustomMetadata = true,
        bool $overwriteFile = true,
        bool $overwriteTags = true,
        ?array $responseFields = null,
        ?array $tags = null,
        ?array $transformation = null,
        bool $useUniqueFileName = true,
        ?string $webhookURL = null,
        ?RequestOptions $requestOptions = null,
    ): FileUploadResponse {
        $params = [
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
            'overwriteAITags' => $overwriteAITags,
            'overwriteCustomMetadata' => $overwriteCustomMetadata,
            'overwriteFile' => $overwriteFile,
            'overwriteTags' => $overwriteTags,
            'responseFields' => $responseFields,
            'tags' => $tags,
            'transformation' => $transformation,
            'useUniqueFileName' => $useUniqueFileName,
            'webhookURL' => $webhookURL,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->upload(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
