<?php

declare(strict_types=1);

namespace Imagekit\Files;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\ExtensionItem;
use Imagekit\Files\FileUploadParams\ResponseField;
use Imagekit\Files\FileUploadParams\Transformation;

/**
 * ImageKit.io allows you to upload files directly from both the server and client sides. For server-side uploads, private API key authentication is used. For client-side uploads, generate a one-time `token`, `signature`, and `expire` from your secure backend using private API. [Learn more](/docs/api-reference/upload-file/upload-file#how-to-implement-client-side-file-upload) about how to implement client-side file upload.
 *
 * The [V2 API](/docs/api-reference/upload-file/upload-file-v2) enhances security by verifying the entire payload using JWT.
 *
 * **File size limit** \
 * On the free plan, the maximum upload file sizes are 25MB for images, audio, and raw files and 100MB for videos. On the Lite paid plan, these limits increase to 40MB for images, audio, and raw files and 300MB for videos, whereas on the Pro paid plan, these limits increase to 50MB for images, audio, and raw files and 2GB for videos. These limits can be further increased with enterprise plans.
 *
 * **Version limit** \
 * A file can have a maximum of 100 versions.
 *
 * **Demo applications**
 *
 * - A full-fledged [upload widget using Uppy](https://github.com/imagekit-samples/uppy-uploader), supporting file selections from local storage, URL, Dropbox, Google Drive, Instagram, and more.
 * - [Quick start guides](/docs/quick-start-guides) for various frameworks and technologies.
 *
 * @see Imagekit\Services\FilesService::upload()
 *
 * @phpstan-import-type ExtensionItemVariants from \Imagekit\ExtensionItem
 * @phpstan-import-type ExtensionItemShape from \Imagekit\ExtensionItem
 * @phpstan-import-type TransformationShape from \Imagekit\Files\FileUploadParams\Transformation
 *
 * @phpstan-type FileUploadParamsShape = array{
 *   file: string,
 *   fileName: string,
 *   token?: string|null,
 *   checks?: string|null,
 *   customCoordinates?: string|null,
 *   customMetadata?: array<string,mixed>|null,
 *   description?: string|null,
 *   expire?: int|null,
 *   extensions?: list<ExtensionItemShape>|null,
 *   folder?: string|null,
 *   isPrivateFile?: bool|null,
 *   isPublished?: bool|null,
 *   overwriteAITags?: bool|null,
 *   overwriteCustomMetadata?: bool|null,
 *   overwriteFile?: bool|null,
 *   overwriteTags?: bool|null,
 *   publicKey?: string|null,
 *   responseFields?: list<ResponseField|value-of<ResponseField>>|null,
 *   signature?: string|null,
 *   tags?: list<string>|null,
 *   transformation?: null|Transformation|TransformationShape,
 *   useUniqueFileName?: bool|null,
 *   webhookURL?: string|null,
 * }
 */
final class FileUploadParams implements BaseModel
{
    /** @use SdkModel<FileUploadParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The API accepts any of the following:
     *
     * - **Binary data** – send the raw bytes as `multipart/form-data`.
     * - **HTTP / HTTPS URL** – a publicly reachable URL that ImageKit’s servers can fetch.
     * - **Base64 string** – the file encoded as a Base64 data URI or plain Base64.
     *
     * When supplying a URL, the server must receive the response headers within 8 seconds; otherwise the request fails with 400 Bad Request.
     */
    #[Required]
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
    #[Required]
    public string $fileName;

    /**
     * A unique value that the ImageKit.io server will use to recognize and prevent subsequent retries for the same request. We suggest using V4 UUIDs, or another random string with enough entropy to avoid collisions. This field is only required for authentication when uploading a file from the client side.
     *
     * **Note**: Sending a value that has been used in the past will result in a validation error. Even if your previous request resulted in an error, you should always send a new value for this field.
     */
    #[Optional]
    public ?string $token;

    /**
     * Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file#upload-api-checks).
     */
    #[Optional]
    public ?string $checks;

    /**
     * Define an important area in the image. This is only relevant for image type files.
     *
     *   - To be passed as a string with the x and y coordinates of the top-left corner, and width and height of the area of interest in the format `x,y,width,height`. For example - `10,10,100,100`
     *   - Can be used with fo-customtransformation.
     *   - If this field is not specified and the file is overwritten, then customCoordinates will be removed.
     */
    #[Optional]
    public ?string $customCoordinates;

    /**
     * JSON key-value pairs to associate with the asset. Create the custom metadata fields before setting these values.
     *
     * @var array<string,mixed>|null $customMetadata
     */
    #[Optional(map: 'mixed')]
    public ?array $customMetadata;

    /**
     * Optional text to describe the contents of the file.
     */
    #[Optional]
    public ?string $description;

    /**
     * The time until your signature is valid. It must be a [Unix time](https://en.wikipedia.org/wiki/Unix_time) in less than 1 hour into the future. It should be in seconds. This field is only required for authentication when uploading a file from the client side.
     */
    #[Optional]
    public ?int $expire;

    /**
     * Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     *
     * @var list<ExtensionItemVariants>|null $extensions
     */
    #[Optional(list: ExtensionItem::class)]
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
    #[Optional]
    public ?string $folder;

    /**
     * Whether to mark the file as private or not.
     *
     * If `true`, the file is marked as private and is accessible only using named transformation or signed URL.
     */
    #[Optional]
    public ?bool $isPrivateFile;

    /**
     * Whether to upload file as published or not.
     *
     * If `false`, the file is marked as unpublished, which restricts access to the file only via the media library. Files in draft or unpublished state can only be publicly accessed after being published.
     *
     * The option to upload in draft state is only available in custom enterprise pricing plans.
     */
    #[Optional]
    public ?bool $isPublished;

    /**
     * If set to `true` and a file already exists at the exact location, its AITags will be removed. Set `overwriteAITags` to `false` to preserve AITags.
     */
    #[Optional]
    public ?bool $overwriteAITags;

    /**
     * If the request does not have `customMetadata`, and a file already exists at the exact location, existing customMetadata will be removed.
     */
    #[Optional]
    public ?bool $overwriteCustomMetadata;

    /**
     * If `false` and `useUniqueFileName` is also `false`, and a file already exists at the exact location, upload API will return an error immediately.
     */
    #[Optional]
    public ?bool $overwriteFile;

    /**
     * If the request does not have `tags`, and a file already exists at the exact location, existing tags will be removed.
     */
    #[Optional]
    public ?bool $overwriteTags;

    /**
     * Your ImageKit.io public key. This field is only required for authentication when uploading a file from the client side.
     */
    #[Optional]
    public ?string $publicKey;

    /**
     * Array of response field keys to include in the API response body.
     *
     * @var list<value-of<ResponseField>>|null $responseFields
     */
    #[Optional(list: ResponseField::class)]
    public ?array $responseFields;

    /**
     * HMAC-SHA1 digest of the token+expire using your ImageKit.io private API key as a key. Learn how to create a signature on the page below. This should be in lowercase.
     *
     * Signature must be calculated on the server-side. This field is only required for authentication when uploading a file from the client side.
     */
    #[Optional]
    public ?string $signature;

    /**
     * Set the tags while uploading the file.
     * Provide an array of tag strings (e.g. `["tag1", "tag2", "tag3"]`). The combined length of all tag characters must not exceed 500, and the `%` character is not allowed.
     * If this field is not specified and the file is overwritten, the existing tags will be removed.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
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
    #[Optional]
    public ?Transformation $transformation;

    /**
     * Whether to use a unique filename for this file or not.
     *
     * If `true`, ImageKit.io will add a unique suffix to the filename parameter to get a unique filename.
     *
     * If `false`, then the image is uploaded with the provided filename parameter, and any existing file with the same name is replaced.
     */
    #[Optional]
    public ?bool $useUniqueFileName;

    /**
     * The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     */
    #[Optional('webhookUrl')]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $customMetadata
     * @param list<ExtensionItemShape>|null $extensions
     * @param list<ResponseField|value-of<ResponseField>>|null $responseFields
     * @param list<string>|null $tags
     * @param Transformation|TransformationShape|null $transformation
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
        Transformation|array|null $transformation = null,
        ?bool $useUniqueFileName = null,
        ?string $webhookURL = null,
    ): self {
        $self = new self;

        $self['file'] = $file;
        $self['fileName'] = $fileName;

        null !== $token && $self['token'] = $token;
        null !== $checks && $self['checks'] = $checks;
        null !== $customCoordinates && $self['customCoordinates'] = $customCoordinates;
        null !== $customMetadata && $self['customMetadata'] = $customMetadata;
        null !== $description && $self['description'] = $description;
        null !== $expire && $self['expire'] = $expire;
        null !== $extensions && $self['extensions'] = $extensions;
        null !== $folder && $self['folder'] = $folder;
        null !== $isPrivateFile && $self['isPrivateFile'] = $isPrivateFile;
        null !== $isPublished && $self['isPublished'] = $isPublished;
        null !== $overwriteAITags && $self['overwriteAITags'] = $overwriteAITags;
        null !== $overwriteCustomMetadata && $self['overwriteCustomMetadata'] = $overwriteCustomMetadata;
        null !== $overwriteFile && $self['overwriteFile'] = $overwriteFile;
        null !== $overwriteTags && $self['overwriteTags'] = $overwriteTags;
        null !== $publicKey && $self['publicKey'] = $publicKey;
        null !== $responseFields && $self['responseFields'] = $responseFields;
        null !== $signature && $self['signature'] = $signature;
        null !== $tags && $self['tags'] = $tags;
        null !== $transformation && $self['transformation'] = $transformation;
        null !== $useUniqueFileName && $self['useUniqueFileName'] = $useUniqueFileName;
        null !== $webhookURL && $self['webhookURL'] = $webhookURL;

        return $self;
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
        $self = clone $this;
        $self['file'] = $file;

        return $self;
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
        $self = clone $this;
        $self['fileName'] = $fileName;

        return $self;
    }

    /**
     * A unique value that the ImageKit.io server will use to recognize and prevent subsequent retries for the same request. We suggest using V4 UUIDs, or another random string with enough entropy to avoid collisions. This field is only required for authentication when uploading a file from the client side.
     *
     * **Note**: Sending a value that has been used in the past will result in a validation error. Even if your previous request resulted in an error, you should always send a new value for this field.
     */
    public function withToken(string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }

    /**
     * Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file#upload-api-checks).
     */
    public function withChecks(string $checks): self
    {
        $self = clone $this;
        $self['checks'] = $checks;

        return $self;
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
        $self = clone $this;
        $self['customCoordinates'] = $customCoordinates;

        return $self;
    }

    /**
     * JSON key-value pairs to associate with the asset. Create the custom metadata fields before setting these values.
     *
     * @param array<string,mixed> $customMetadata
     */
    public function withCustomMetadata(array $customMetadata): self
    {
        $self = clone $this;
        $self['customMetadata'] = $customMetadata;

        return $self;
    }

    /**
     * Optional text to describe the contents of the file.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The time until your signature is valid. It must be a [Unix time](https://en.wikipedia.org/wiki/Unix_time) in less than 1 hour into the future. It should be in seconds. This field is only required for authentication when uploading a file from the client side.
     */
    public function withExpire(int $expire): self
    {
        $self = clone $this;
        $self['expire'] = $expire;

        return $self;
    }

    /**
     * Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     *
     * @param list<ExtensionItemShape> $extensions
     */
    public function withExtensions(array $extensions): self
    {
        $self = clone $this;
        $self['extensions'] = $extensions;

        return $self;
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
        $self = clone $this;
        $self['folder'] = $folder;

        return $self;
    }

    /**
     * Whether to mark the file as private or not.
     *
     * If `true`, the file is marked as private and is accessible only using named transformation or signed URL.
     */
    public function withIsPrivateFile(bool $isPrivateFile): self
    {
        $self = clone $this;
        $self['isPrivateFile'] = $isPrivateFile;

        return $self;
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
        $self = clone $this;
        $self['isPublished'] = $isPublished;

        return $self;
    }

    /**
     * If set to `true` and a file already exists at the exact location, its AITags will be removed. Set `overwriteAITags` to `false` to preserve AITags.
     */
    public function withOverwriteAITags(bool $overwriteAITags): self
    {
        $self = clone $this;
        $self['overwriteAITags'] = $overwriteAITags;

        return $self;
    }

    /**
     * If the request does not have `customMetadata`, and a file already exists at the exact location, existing customMetadata will be removed.
     */
    public function withOverwriteCustomMetadata(
        bool $overwriteCustomMetadata
    ): self {
        $self = clone $this;
        $self['overwriteCustomMetadata'] = $overwriteCustomMetadata;

        return $self;
    }

    /**
     * If `false` and `useUniqueFileName` is also `false`, and a file already exists at the exact location, upload API will return an error immediately.
     */
    public function withOverwriteFile(bool $overwriteFile): self
    {
        $self = clone $this;
        $self['overwriteFile'] = $overwriteFile;

        return $self;
    }

    /**
     * If the request does not have `tags`, and a file already exists at the exact location, existing tags will be removed.
     */
    public function withOverwriteTags(bool $overwriteTags): self
    {
        $self = clone $this;
        $self['overwriteTags'] = $overwriteTags;

        return $self;
    }

    /**
     * Your ImageKit.io public key. This field is only required for authentication when uploading a file from the client side.
     */
    public function withPublicKey(string $publicKey): self
    {
        $self = clone $this;
        $self['publicKey'] = $publicKey;

        return $self;
    }

    /**
     * Array of response field keys to include in the API response body.
     *
     * @param list<ResponseField|value-of<ResponseField>> $responseFields
     */
    public function withResponseFields(array $responseFields): self
    {
        $self = clone $this;
        $self['responseFields'] = $responseFields;

        return $self;
    }

    /**
     * HMAC-SHA1 digest of the token+expire using your ImageKit.io private API key as a key. Learn how to create a signature on the page below. This should be in lowercase.
     *
     * Signature must be calculated on the server-side. This field is only required for authentication when uploading a file from the client side.
     */
    public function withSignature(string $signature): self
    {
        $self = clone $this;
        $self['signature'] = $signature;

        return $self;
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
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
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
     *
     * @param Transformation|TransformationShape $transformation
     */
    public function withTransformation(
        Transformation|array $transformation
    ): self {
        $self = clone $this;
        $self['transformation'] = $transformation;

        return $self;
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
        $self = clone $this;
        $self['useUniqueFileName'] = $useUniqueFileName;

        return $self;
    }

    /**
     * The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     */
    public function withWebhookURL(string $webhookURL): self
    {
        $self = clone $this;
        $self['webhookURL'] = $webhookURL;

        return $self;
    }
}
