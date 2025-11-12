<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files;

use ImageKit\Beta\V2\Files\FileUploadParams\ResponseField;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\ExtensionItem;
use ImageKit\ExtensionItem\AIAutoDescription;
use ImageKit\ExtensionItem\AutoTaggingExtension;
use ImageKit\ExtensionItem\RemoveBg;

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
 * @see ImageKit\STAINLESS_FIXME_Beta\STAINLESS_FIXME_V2\FilesService::upload()
 *
 * @phpstan-type FileUploadParamsShape = array{
 *   file: string,
 *   fileName: string,
 *   token?: string,
 *   checks?: string,
 *   customCoordinates?: string,
 *   customMetadata?: array<string,mixed>,
 *   description?: string,
 *   extensions?: list<RemoveBg|AutoTaggingExtension|AIAutoDescription>,
 *   folder?: string,
 *   isPrivateFile?: bool,
 *   isPublished?: bool,
 *   overwriteAITags?: bool,
 *   overwriteCustomMetadata?: bool,
 *   overwriteFile?: bool,
 *   overwriteTags?: bool,
 *   responseFields?: list<ResponseField|value-of<ResponseField>>,
 *   tags?: list<string>,
 *   transformation?: Transformation,
 *   useUniqueFileName?: bool,
 *   webhookUrl?: string,
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
    #[Api]
    public string $file;

    /**
     * The name with which the file has to be uploaded.
     */
    #[Api]
    public string $fileName;

    /**
     * This is the client-generated JSON Web Token (JWT). The ImageKit.io server uses it to authenticate and check that the upload request parameters have not been tampered with after the token has been generated. Learn how to create the token on the page below. This field is only required for authentication when uploading a file from the client side.
     *
     * **Note**: Sending a JWT that has been used in the past will result in a validation error. Even if your previous request resulted in an error, you should always send a new token.
     *
     *
     * **⚠️Warning**: JWT must be generated on the server-side because it is generated using your account's private API key. This field is required for authentication when uploading a file from the client-side.
     */
    #[Api(optional: true)]
    public ?string $token;

    /**
     * Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file-v2#upload-api-checks).
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
     * @var array<string,mixed>|null $customMetadata
     */
    #[Api(map: 'mixed', optional: true)]
    public ?array $customMetadata;

    /**
     * Optional text to describe the contents of the file.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     *
     * @var list<RemoveBg|AutoTaggingExtension|AIAutoDescription>|null $extensions
     */
    #[Api(list: ExtensionItem::class, optional: true)]
    public ?array $extensions;

    /**
     * The folder path in which the image has to be uploaded. If the folder(s) didn't exist before, a new folder(s) is created. Using multiple `/` creates a nested folder.
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
     * Array of response field keys to include in the API response body.
     *
     * @var list<value-of<ResponseField>>|null $responseFields
     */
    #[Api(list: ResponseField::class, optional: true)]
    public ?array $responseFields;

    /**
     * Set the tags while uploading the file.
     * Provide an array of tag strings (e.g. `["tag1", "tag2", "tag3"]`). The combined length of all tag characters must not exceed 500, and the `%` character is not allowed.
     * If this field is not specified and the file is overwritten, the existing tags will be removed.
     *
     * @var list<string>|null $tags
     */
    #[Api(list: 'string', optional: true)]
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
    #[Api(optional: true)]
    public ?string $webhookUrl;

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
     * @param array<string,mixed> $customMetadata
     * @param list<RemoveBg|AutoTaggingExtension|AIAutoDescription> $extensions
     * @param list<ResponseField|value-of<ResponseField>> $responseFields
     * @param list<string> $tags
     */
    public static function with(
        string $file,
        string $fileName,
        ?string $token = null,
        ?string $checks = null,
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?string $description = null,
        ?array $extensions = null,
        ?string $folder = null,
        ?bool $isPrivateFile = null,
        ?bool $isPublished = null,
        ?bool $overwriteAITags = null,
        ?bool $overwriteCustomMetadata = null,
        ?bool $overwriteFile = null,
        ?bool $overwriteTags = null,
        ?array $responseFields = null,
        ?array $tags = null,
        ?Transformation $transformation = null,
        ?bool $useUniqueFileName = null,
        ?string $webhookUrl = null,
    ): self {
        $obj = new self;

        $obj->file = $file;
        $obj->fileName = $fileName;

        null !== $token && $obj->token = $token;
        null !== $checks && $obj->checks = $checks;
        null !== $customCoordinates && $obj->customCoordinates = $customCoordinates;
        null !== $customMetadata && $obj->customMetadata = $customMetadata;
        null !== $description && $obj->description = $description;
        null !== $extensions && $obj->extensions = $extensions;
        null !== $folder && $obj->folder = $folder;
        null !== $isPrivateFile && $obj->isPrivateFile = $isPrivateFile;
        null !== $isPublished && $obj->isPublished = $isPublished;
        null !== $overwriteAITags && $obj->overwriteAITags = $overwriteAITags;
        null !== $overwriteCustomMetadata && $obj->overwriteCustomMetadata = $overwriteCustomMetadata;
        null !== $overwriteFile && $obj->overwriteFile = $overwriteFile;
        null !== $overwriteTags && $obj->overwriteTags = $overwriteTags;
        null !== $responseFields && $obj['responseFields'] = $responseFields;
        null !== $tags && $obj->tags = $tags;
        null !== $transformation && $obj->transformation = $transformation;
        null !== $useUniqueFileName && $obj->useUniqueFileName = $useUniqueFileName;
        null !== $webhookUrl && $obj->webhookUrl = $webhookUrl;

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
     */
    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj->fileName = $fileName;

        return $obj;
    }

    /**
     * This is the client-generated JSON Web Token (JWT). The ImageKit.io server uses it to authenticate and check that the upload request parameters have not been tampered with after the token has been generated. Learn how to create the token on the page below. This field is only required for authentication when uploading a file from the client side.
     *
     * **Note**: Sending a JWT that has been used in the past will result in a validation error. Even if your previous request resulted in an error, you should always send a new token.
     *
     *
     * **⚠️Warning**: JWT must be generated on the server-side because it is generated using your account's private API key. This field is required for authentication when uploading a file from the client-side.
     */
    public function withToken(string $token): self
    {
        $obj = clone $this;
        $obj->token = $token;

        return $obj;
    }

    /**
     * Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file-v2#upload-api-checks).
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
     * @param array<string,mixed> $customMetadata
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
     * Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     *
     * @param list<RemoveBg|AutoTaggingExtension|AIAutoDescription> $extensions
     */
    public function withExtensions(array $extensions): self
    {
        $obj = clone $this;
        $obj->extensions = $extensions;

        return $obj;
    }

    /**
     * The folder path in which the image has to be uploaded. If the folder(s) didn't exist before, a new folder(s) is created. Using multiple `/` creates a nested folder.
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
     * Array of response field keys to include in the API response body.
     *
     * @param list<ResponseField|value-of<ResponseField>> $responseFields
     */
    public function withResponseFields(array $responseFields): self
    {
        $obj = clone $this;
        $obj['responseFields'] = $responseFields;

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
        $obj->webhookUrl = $webhookURL;

        return $obj;
    }
}
