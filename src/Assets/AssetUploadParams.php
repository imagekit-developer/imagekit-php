<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Assets\AssetUploadParams\Overwrite;
use ImageKit\Assets\AssetUploadParams\Transformation;
use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\FileParam;
use ImageKit\ExtensionItem;

/**
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
 * @see ImageKit\Services\AssetsService::upload()
 *
 * @phpstan-import-type ExtensionItemVariants from \ImageKit\ExtensionItem
 * @phpstan-import-type ExtensionItemShape from \ImageKit\ExtensionItem
 * @phpstan-import-type OverwriteShape from \ImageKit\Assets\AssetUploadParams\Overwrite
 * @phpstan-import-type TransformationShape from \ImageKit\Assets\AssetUploadParams\Transformation
 *
 * @phpstan-type AssetUploadParamsShape = array{
 *   file: string|FileParam,
 *   fileName: string,
 *   token?: string|null,
 *   checks?: string|null,
 *   customCoordinates?: string|null,
 *   customMetadata?: array<string,mixed>|null,
 *   description?: string|null,
 *   extensions?: list<ExtensionItemShape>|null,
 *   folder?: string|null,
 *   isPrivateFile?: bool|null,
 *   isPublished?: bool|null,
 *   overwrite?: null|Overwrite|OverwriteShape,
 *   tags?: list<string>|null,
 *   transformation?: null|Transformation|TransformationShape,
 *   useUniqueFileName?: bool|null,
 * }
 */
final class AssetUploadParams implements BaseModel
{
    /** @use SdkModel<AssetUploadParamsShape> */
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
     * The name to use for the uploaded file.
     */
    #[Required('file_name')]
    public string $fileName;

    /**
     * This is the client-generated JSON Web Token (JWT). The ImageKit.io server uses it to authenticate and check that the upload request parameters have not been tampered with after the token has been generated. Learn how to create the token on the page below. This field is only required for authentication when uploading a file from the client side.
     *
     * **Note**: Sending a JWT that has been used in the past will result in a validation error. Even if your previous request resulted in an error, you should always send a new token.
     *
     *
     * **⚠️Warning**: JWT must be generated on the server-side because it is generated using your account's private API key. This field is required for authentication when uploading a file from the client-side.
     */
    #[Optional]
    public ?string $token;

    /**
     * Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file-v2#upload-api-checks).
     */
    #[Optional]
    public ?string $checks;

    /**
     * Define an important area in the image. This is only relevant for image type files.
     *
     *   - To be passed as a string with the x and y coordinates of the top-left corner, and width and height of the area of interest in the format `x,y,width,height`. For example - `10,10,100,100`
     *   - Can be used with fo-customtransformation.
     *   - If this field is not specified and the file is overwritten, then custom_coordinates will be removed.
     */
    #[Optional('custom_coordinates')]
    public ?string $customCoordinates;

    /**
     * JSON key-value pairs to associate with the asset. Create the custom metadata fields before setting these values.
     *
     * @var array<string,mixed>|null $customMetadata
     */
    #[Optional('custom_metadata', map: 'mixed')]
    public ?array $customMetadata;

    /**
     * Optional text to describe the contents of the file.
     */
    #[Optional]
    public ?string $description;

    /**
     * Array of extensions to be applied to the asset. Each extension can be configured with specific parameters based on the extension type.
     *
     * @var list<ExtensionItemVariants>|null $extensions
     */
    #[Optional(list: ExtensionItem::class)]
    public ?array $extensions;

    /**
     * The folder path in which the image has to be uploaded. If the folder(s) didn't exist before, a new folder(s) is created. Using multiple `/` creates a nested folder.
     */
    #[Optional]
    public ?string $folder;

    /**
     * Whether to mark the file as private or not.
     *
     * If `true`, the file is marked as private and is accessible only using named transformation or signed URL.
     */
    #[Optional('is_private_file')]
    public ?bool $isPrivateFile;

    /**
     * Whether to upload file as published or not.
     *
     * If `false`, the file is marked as unpublished, which restricts access to the file only via the media library. Files in draft or unpublished state can only be publicly accessed after being published.
     *
     * The option to upload in draft state is only available in custom enterprise pricing plans.
     */
    #[Optional('is_published')]
    public ?bool $isPublished;

    /**
     * Controls what gets replaced when a file already exists at the same path. All fields default to `true`. Only relevant when `use_unique_file_name` is `false`.
     */
    #[Optional]
    public ?Overwrite $overwrite;

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
    #[Optional('use_unique_file_name')]
    public ?bool $useUniqueFileName;

    /**
     * `new AssetUploadParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetUploadParams::with(file: ..., fileName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetUploadParams)->withFile(...)->withFileName(...)
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
     * @param Overwrite|OverwriteShape|null $overwrite
     * @param list<string>|null $tags
     * @param Transformation|TransformationShape|null $transformation
     */
    public static function with(
        string|FileParam $file,
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
        Overwrite|array|null $overwrite = null,
        ?array $tags = null,
        Transformation|array|null $transformation = null,
        ?bool $useUniqueFileName = null,
    ): self {
        $self = new self;

        $self['file'] = $file;
        $self['fileName'] = $fileName;

        null !== $token && $self['token'] = $token;
        null !== $checks && $self['checks'] = $checks;
        null !== $customCoordinates && $self['customCoordinates'] = $customCoordinates;
        null !== $customMetadata && $self['customMetadata'] = $customMetadata;
        null !== $description && $self['description'] = $description;
        null !== $extensions && $self['extensions'] = $extensions;
        null !== $folder && $self['folder'] = $folder;
        null !== $isPrivateFile && $self['isPrivateFile'] = $isPrivateFile;
        null !== $isPublished && $self['isPublished'] = $isPublished;
        null !== $overwrite && $self['overwrite'] = $overwrite;
        null !== $tags && $self['tags'] = $tags;
        null !== $transformation && $self['transformation'] = $transformation;
        null !== $useUniqueFileName && $self['useUniqueFileName'] = $useUniqueFileName;

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
    public function withFile(string|FileParam $file): self
    {
        $self = clone $this;
        $self['file'] = $file;

        return $self;
    }

    /**
     * The name to use for the uploaded file.
     */
    public function withFileName(string $fileName): self
    {
        $self = clone $this;
        $self['fileName'] = $fileName;

        return $self;
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
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }

    /**
     * Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file-v2#upload-api-checks).
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
     *   - If this field is not specified and the file is overwritten, then custom_coordinates will be removed.
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
     * The folder path in which the image has to be uploaded. If the folder(s) didn't exist before, a new folder(s) is created. Using multiple `/` creates a nested folder.
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
     * Controls what gets replaced when a file already exists at the same path. All fields default to `true`. Only relevant when `use_unique_file_name` is `false`.
     *
     * @param Overwrite|OverwriteShape $overwrite
     */
    public function withOverwrite(Overwrite|array $overwrite): self
    {
        $self = clone $this;
        $self['overwrite'] = $overwrite;

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
}
