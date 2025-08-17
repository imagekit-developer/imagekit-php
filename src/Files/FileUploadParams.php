<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Core\Conversion\MapOf;
use ImageKit\Files\FileUploadParams\Extension;
use ImageKit\Files\FileUploadParams\ResponseField;
use ImageKit\Files\FileUploadParams\Transformation;
use ImageKit\Shared\AutoDescriptionExtension;
use ImageKit\Shared\AutoTaggingExtension;
use ImageKit\Shared\RemovedotBgExtension;

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
 * @phpstan-type upload_params = array{
 *   file: string,
 *   fileName: string,
 *   token?: string,
 *   checks?: string,
 *   customCoordinates?: string,
 *   customMetadata?: array<string, mixed>,
 *   description?: string,
 *   expire?: int,
 *   extensions?: list<RemovedotBgExtension|AutoTaggingExtension|AutoDescriptionExtension>,
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
 * }
 */
final class FileUploadParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * The API accepts any of the following:
     *
     * - **Binary data** – send the raw bytes as `multipart/form-data`.
     * - **HTTP / HTTPS URL** – a publicly reachable URL that ImageKit’s servers can fetch.
     * - **Base64 string** – the file encoded as a Base64 data URI or plain Base64.
     *
     * When supplying a URL, the server must receive the response headers within 8 seconds; otherwise the request fails with 400 Bad Request.
     */
    #[Api]
    public string $file;

    /**
     * The name with which the file has to be uploaded.
     * The file name can contain:
     *
     *   - Alphanumeric Characters: `a-z`, `A-Z`, `0-9`.
     *   - Special Characters: `.`, `-`
     *
     * Any other character including space will be replaced by `_`
     */
    #[Api]
    public string $fileName;

    /**
     * A unique value that the ImageKit.io server will use to recognize and prevent subsequent retries for the same request. We suggest using V4 UUIDs, or another random string with enough entropy to avoid collisions. This field is only required for authentication when uploading a file from the client side.
     *
     * **Note**: Sending a value that has been used in the past will result in a validation error. Even if your previous request resulted in an error, you should always send a new value for this field.
     */
    #[Api(optional: true)]
    public ?string $token;

    /**
     * Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file#upload-api-checks).
     */
    #[Api(optional: true)]
    public ?string $checks;

    /**
     * Define an important area in the image. This is only relevant for image type files.
     *
     *   - To be passed as a string with the x and y coordinates of the top-left corner, and width and height of the area of interest in the format `x,y,width,height`. For example - `10,10,100,100`
     *   - Can be used with fo-customtransformation.
     *   - If this field is not specified and the file is overwritten, then customCoordinates will be removed.
     */
    #[Api(optional: true)]
    public ?string $customCoordinates;

    /**
     * JSON key-value pairs to associate with the asset. Create the custom metadata fields before setting these values.
     *
     * @var null|array<string, mixed> $customMetadata
     */
    #[Api(type: new MapOf('string'), optional: true)]
    public ?array $customMetadata;

    /**
     * Optional text to describe the contents of the file.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * The time until your signature is valid. It must be a [Unix time](https://en.wikipedia.org/wiki/Unix_time) in less than 1 hour into the future. It should be in seconds. This field is only required for authentication when uploading a file from the client side.
     */
    #[Api(optional: true)]
    public ?int $expire;

    /**
     * Array of extensions to be applied to the image. Each extension can be configured with specific parameters based on the extension type.
     *
     * @var null|list<AutoDescriptionExtension|AutoTaggingExtension|RemovedotBgExtension> $extensions
     */
    #[Api(type: new ListOf(union: Extension::class), optional: true)]
    public ?array $extensions;

    /**
     * The folder path in which the image has to be uploaded. If the folder(s) didn't exist before, a new folder(s) is created.
     *
     * The folder name can contain:
     *
     *   - Alphanumeric Characters: `a-z` , `A-Z` , `0-9`
     *   - Special Characters: `/` , `_` , `-`
     *
     * Using multiple `/` creates a nested folder.
     */
    #[Api(optional: true)]
    public ?string $folder;

    /**
     * Whether to mark the file as private or not.
     *
     * If `true`, the file is marked as private and is accessible only using named transformation or signed URL.
     */
    #[Api(optional: true)]
    public ?bool $isPrivateFile;

    /**
     * Whether to upload file as published or not.
     *
     * If `false`, the file is marked as unpublished, which restricts access to the file only via the media library. Files in draft or unpublished state can only be publicly accessed after being published.
     *
     * The option to upload in draft state is only available in custom enterprise pricing plans.
     */
    #[Api(optional: true)]
    public ?bool $isPublished;

    /**
     * If set to `true` and a file already exists at the exact location, its AITags will be removed. Set `overwriteAITags` to `false` to preserve AITags.
     */
    #[Api(optional: true)]
    public ?bool $overwriteAITags;

    /**
     * If the request does not have `customMetadata`, and a file already exists at the exact location, existing customMetadata will be removed.
     */
    #[Api(optional: true)]
    public ?bool $overwriteCustomMetadata;

    /**
     * If `false` and `useUniqueFileName` is also `false`, and a file already exists at the exact location, upload API will return an error immediately.
     */
    #[Api(optional: true)]
    public ?bool $overwriteFile;

    /**
     * If the request does not have `tags`, and a file already exists at the exact location, existing tags will be removed.
     */
    #[Api(optional: true)]
    public ?bool $overwriteTags;

    /**
     * Your ImageKit.io public key. This field is only required for authentication when uploading a file from the client side.
     */
    #[Api(optional: true)]
    public ?string $publicKey;

    /**
     * Array of response field keys to include in the API response body.
     *
     * @var null|list<ResponseField::*> $responseFields
     */
    #[Api(type: new ListOf(enum: ResponseField::class), optional: true)]
    public ?array $responseFields;

    /**
     * HMAC-SHA1 digest of the token+expire using your ImageKit.io private API key as a key. Learn how to create a signature on the page below. This should be in lowercase.
     *
     * Signature must be calculated on the server-side. This field is only required for authentication when uploading a file from the client side.
     */
    #[Api(optional: true)]
    public ?string $signature;

    /**
     * Set the tags while uploading the file.
     * Provide an array of tag strings (e.g. `["tag1", "tag2", "tag3"]`). The combined length of all tag characters must not exceed 500, and the `%` character is not allowed.
     * If this field is not specified and the file is overwritten, the existing tags will be removed.
     *
     * @var null|list<string> $tags
     */
    #[Api(type: new ListOf('string'), optional: true)]
    public ?array $tags;

    /**
     * Configure pre-processing (`pre`) and post-processing (`post`) transformations.
     *
     * - `pre` — applied before the file is uploaded to the Media Library.
     *   Useful for reducing file size or applying basic optimizations upfront (e.g., resize, compress).
     *
     * - `post` — applied immediately after upload.
     *   Ideal for generating transformed versions (like video encodes or thumbnails) in advance, so they're ready for delivery without delay.
     *
     * You can mix and match any combination of post-processing types.
     */
    #[Api(optional: true)]
    public ?Transformation $transformation;

    /**
     * Whether to use a unique filename for this file or not.
     *
     * If `true`, ImageKit.io will add a unique suffix to the filename parameter to get a unique filename.
     *
     * If `false`, then the image is uploaded with the provided filename parameter, and any existing file with the same name is replaced.
     */
    #[Api(optional: true)]
    public ?bool $useUniqueFileName;

    /**
     * The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     */
    #[Api('webhookUrl', optional: true)]
    public ?string $webhookURL;

    /**
     * `new FileUploadParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileUploadParams::with(file: ..., fileName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileUploadParams)->withFile(...)->withFileName(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|array<string, mixed> $customMetadata
     * @param null|list<AutoDescriptionExtension|AutoTaggingExtension|RemovedotBgExtension> $extensions
     * @param null|list<ResponseField::*> $responseFields
     * @param null|list<string> $tags
     */
    public static function with(
        string $file,
        string $fileName,
        ?string $token = null,
        ?string $checks = null,
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?string $description = null,
        ?int $expire = null,
        ?array $extensions = null,
        ?string $folder = null,
        ?bool $isPrivateFile = null,
        ?bool $isPublished = null,
        ?bool $overwriteAITags = null,
        ?bool $overwriteCustomMetadata = null,
        ?bool $overwriteFile = null,
        ?bool $overwriteTags = null,
        ?string $publicKey = null,
        ?array $responseFields = null,
        ?string $signature = null,
        ?array $tags = null,
        ?Transformation $transformation = null,
        ?bool $useUniqueFileName = null,
        ?string $webhookURL = null,
    ): self {
        $obj = new self;

        $obj->file = $file;
        $obj->fileName = $fileName;

        null !== $token && $obj->token = $token;
        null !== $checks && $obj->checks = $checks;
        null !== $customCoordinates && $obj->customCoordinates = $customCoordinates;
        null !== $customMetadata && $obj->customMetadata = $customMetadata;
        null !== $description && $obj->description = $description;
        null !== $expire && $obj->expire = $expire;
        null !== $extensions && $obj->extensions = $extensions;
        null !== $folder && $obj->folder = $folder;
        null !== $isPrivateFile && $obj->isPrivateFile = $isPrivateFile;
        null !== $isPublished && $obj->isPublished = $isPublished;
        null !== $overwriteAITags && $obj->overwriteAITags = $overwriteAITags;
        null !== $overwriteCustomMetadata && $obj->overwriteCustomMetadata = $overwriteCustomMetadata;
        null !== $overwriteFile && $obj->overwriteFile = $overwriteFile;
        null !== $overwriteTags && $obj->overwriteTags = $overwriteTags;
        null !== $publicKey && $obj->publicKey = $publicKey;
        null !== $responseFields && $obj->responseFields = $responseFields;
        null !== $signature && $obj->signature = $signature;
        null !== $tags && $obj->tags = $tags;
        null !== $transformation && $obj->transformation = $transformation;
        null !== $useUniqueFileName && $obj->useUniqueFileName = $useUniqueFileName;
        null !== $webhookURL && $obj->webhookURL = $webhookURL;

        return $obj;
    }

    /**
     * The API accepts any of the following:
     *
     * - **Binary data** – send the raw bytes as `multipart/form-data`.
     * - **HTTP / HTTPS URL** – a publicly reachable URL that ImageKit’s servers can fetch.
     * - **Base64 string** – the file encoded as a Base64 data URI or plain Base64.
     *
     * When supplying a URL, the server must receive the response headers within 8 seconds; otherwise the request fails with 400 Bad Request.
     */
    public function withFile(string $file): self
    {
        $obj = clone $this;
        $obj->file = $file;

        return $obj;
    }

    /**
     * The name with which the file has to be uploaded.
     * The file name can contain:
     *
     *   - Alphanumeric Characters: `a-z`, `A-Z`, `0-9`.
     *   - Special Characters: `.`, `-`
     *
     * Any other character including space will be replaced by `_`
     */
    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj->fileName = $fileName;

        return $obj;
    }

    /**
     * A unique value that the ImageKit.io server will use to recognize and prevent subsequent retries for the same request. We suggest using V4 UUIDs, or another random string with enough entropy to avoid collisions. This field is only required for authentication when uploading a file from the client side.
     *
     * **Note**: Sending a value that has been used in the past will result in a validation error. Even if your previous request resulted in an error, you should always send a new value for this field.
     */
    public function withToken(string $token): self
    {
        $obj = clone $this;
        $obj->token = $token;

        return $obj;
    }

    /**
     * Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file#upload-api-checks).
     */
    public function withChecks(string $checks): self
    {
        $obj = clone $this;
        $obj->checks = $checks;

        return $obj;
    }

    /**
     * Define an important area in the image. This is only relevant for image type files.
     *
     *   - To be passed as a string with the x and y coordinates of the top-left corner, and width and height of the area of interest in the format `x,y,width,height`. For example - `10,10,100,100`
     *   - Can be used with fo-customtransformation.
     *   - If this field is not specified and the file is overwritten, then customCoordinates will be removed.
     */
    public function withCustomCoordinates(string $customCoordinates): self
    {
        $obj = clone $this;
        $obj->customCoordinates = $customCoordinates;

        return $obj;
    }

    /**
     * JSON key-value pairs to associate with the asset. Create the custom metadata fields before setting these values.
     *
     * @param array<string, mixed> $customMetadata
     */
    public function withCustomMetadata(array $customMetadata): self
    {
        $obj = clone $this;
        $obj->customMetadata = $customMetadata;

        return $obj;
    }

    /**
     * Optional text to describe the contents of the file.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * The time until your signature is valid. It must be a [Unix time](https://en.wikipedia.org/wiki/Unix_time) in less than 1 hour into the future. It should be in seconds. This field is only required for authentication when uploading a file from the client side.
     */
    public function withExpire(int $expire): self
    {
        $obj = clone $this;
        $obj->expire = $expire;

        return $obj;
    }

    /**
     * Array of extensions to be applied to the image. Each extension can be configured with specific parameters based on the extension type.
     *
     * @param list<AutoDescriptionExtension|AutoTaggingExtension|RemovedotBgExtension> $extensions
     */
    public function withExtensions(array $extensions): self
    {
        $obj = clone $this;
        $obj->extensions = $extensions;

        return $obj;
    }

    /**
     * The folder path in which the image has to be uploaded. If the folder(s) didn't exist before, a new folder(s) is created.
     *
     * The folder name can contain:
     *
     *   - Alphanumeric Characters: `a-z` , `A-Z` , `0-9`
     *   - Special Characters: `/` , `_` , `-`
     *
     * Using multiple `/` creates a nested folder.
     */
    public function withFolder(string $folder): self
    {
        $obj = clone $this;
        $obj->folder = $folder;

        return $obj;
    }

    /**
     * Whether to mark the file as private or not.
     *
     * If `true`, the file is marked as private and is accessible only using named transformation or signed URL.
     */
    public function withIsPrivateFile(bool $isPrivateFile): self
    {
        $obj = clone $this;
        $obj->isPrivateFile = $isPrivateFile;

        return $obj;
    }

    /**
     * Whether to upload file as published or not.
     *
     * If `false`, the file is marked as unpublished, which restricts access to the file only via the media library. Files in draft or unpublished state can only be publicly accessed after being published.
     *
     * The option to upload in draft state is only available in custom enterprise pricing plans.
     */
    public function withIsPublished(bool $isPublished): self
    {
        $obj = clone $this;
        $obj->isPublished = $isPublished;

        return $obj;
    }

    /**
     * If set to `true` and a file already exists at the exact location, its AITags will be removed. Set `overwriteAITags` to `false` to preserve AITags.
     */
    public function withOverwriteAITags(bool $overwriteAITags): self
    {
        $obj = clone $this;
        $obj->overwriteAITags = $overwriteAITags;

        return $obj;
    }

    /**
     * If the request does not have `customMetadata`, and a file already exists at the exact location, existing customMetadata will be removed.
     */
    public function withOverwriteCustomMetadata(
        bool $overwriteCustomMetadata
    ): self {
        $obj = clone $this;
        $obj->overwriteCustomMetadata = $overwriteCustomMetadata;

        return $obj;
    }

    /**
     * If `false` and `useUniqueFileName` is also `false`, and a file already exists at the exact location, upload API will return an error immediately.
     */
    public function withOverwriteFile(bool $overwriteFile): self
    {
        $obj = clone $this;
        $obj->overwriteFile = $overwriteFile;

        return $obj;
    }

    /**
     * If the request does not have `tags`, and a file already exists at the exact location, existing tags will be removed.
     */
    public function withOverwriteTags(bool $overwriteTags): self
    {
        $obj = clone $this;
        $obj->overwriteTags = $overwriteTags;

        return $obj;
    }

    /**
     * Your ImageKit.io public key. This field is only required for authentication when uploading a file from the client side.
     */
    public function withPublicKey(string $publicKey): self
    {
        $obj = clone $this;
        $obj->publicKey = $publicKey;

        return $obj;
    }

    /**
     * Array of response field keys to include in the API response body.
     *
     * @param list<ResponseField::*> $responseFields
     */
    public function withResponseFields(array $responseFields): self
    {
        $obj = clone $this;
        $obj->responseFields = $responseFields;

        return $obj;
    }

    /**
     * HMAC-SHA1 digest of the token+expire using your ImageKit.io private API key as a key. Learn how to create a signature on the page below. This should be in lowercase.
     *
     * Signature must be calculated on the server-side. This field is only required for authentication when uploading a file from the client side.
     */
    public function withSignature(string $signature): self
    {
        $obj = clone $this;
        $obj->signature = $signature;

        return $obj;
    }

    /**
     * Set the tags while uploading the file.
     * Provide an array of tag strings (e.g. `["tag1", "tag2", "tag3"]`). The combined length of all tag characters must not exceed 500, and the `%` character is not allowed.
     * If this field is not specified and the file is overwritten, the existing tags will be removed.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $obj = clone $this;
        $obj->tags = $tags;

        return $obj;
    }

    /**
     * Configure pre-processing (`pre`) and post-processing (`post`) transformations.
     *
     * - `pre` — applied before the file is uploaded to the Media Library.
     *   Useful for reducing file size or applying basic optimizations upfront (e.g., resize, compress).
     *
     * - `post` — applied immediately after upload.
     *   Ideal for generating transformed versions (like video encodes or thumbnails) in advance, so they're ready for delivery without delay.
     *
     * You can mix and match any combination of post-processing types.
     */
    public function withTransformation(Transformation $transformation): self
    {
        $obj = clone $this;
        $obj->transformation = $transformation;

        return $obj;
    }

    /**
     * Whether to use a unique filename for this file or not.
     *
     * If `true`, ImageKit.io will add a unique suffix to the filename parameter to get a unique filename.
     *
     * If `false`, then the image is uploaded with the provided filename parameter, and any existing file with the same name is replaced.
     */
    public function withUseUniqueFileName(bool $useUniqueFileName): self
    {
        $obj = clone $this;
        $obj->useUniqueFileName = $useUniqueFileName;

        return $obj;
    }

    /**
     * The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     */
    public function withWebhookURL(string $webhookURL): self
    {
        $obj = clone $this;
        $obj->webhookURL = $webhookURL;

        return $obj;
    }
}
