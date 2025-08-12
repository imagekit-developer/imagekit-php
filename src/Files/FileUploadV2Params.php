<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\FileUploadV2Params\IsPrivateFile;
use ImageKit\Files\FileUploadV2Params\IsPublished;
use ImageKit\Files\FileUploadV2Params\OverwriteAITags;
use ImageKit\Files\FileUploadV2Params\OverwriteCustomMetadata;
use ImageKit\Files\FileUploadV2Params\OverwriteTags;
use ImageKit\Files\FileUploadV2Params\UseUniqueFileName;

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
 * @phpstan-type upload_v2_params = array{
 *   file: string,
 *   fileName: string,
 *   token?: string,
 *   checks?: string,
 *   customCoordinates?: string,
 *   customMetadata?: string,
 *   extensions?: string,
 *   folder?: string,
 *   isPrivateFile?: IsPrivateFile::*,
 *   isPublished?: IsPublished::*,
 *   overwriteAITags?: OverwriteAITags::*,
 *   overwriteCustomMetadata?: OverwriteCustomMetadata::*,
 *   overwriteFile?: string,
 *   overwriteTags?: OverwriteTags::*,
 *   responseFields?: string,
 *   tags?: string,
 *   transformation?: string,
 *   useUniqueFileName?: UseUniqueFileName::*,
 *   webhookURL?: string,
 * }
 */
final class FileUploadV2Params implements BaseModel
{
    use Model;
    use Params;

    /**
     * Pass the HTTP URL or base64 string. When passing a URL in the file parameter, please ensure that our servers can access the URL. In case ImageKit is unable to download the file from the specified URL, a `400` error response is returned. This will also result in a `400` error if the file download request is aborted if response headers are not received in 8 seconds.
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
     * Stringified JSON key-value data to be associated with the asset.
     */
    #[Api(optional: true)]
    public ?string $customMetadata;

    /**
     * Stringified JSON object with an array of extensions to be applied to the image. Refer to extensions schema in [update file API request body](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#request-body).
     */
    #[Api(optional: true)]
    public ?string $extensions;

    /**
     * The folder path in which the image has to be uploaded. If the folder(s) didn't exist before, a new folder(s) is created. Using multiple `/` creates a nested folder.
     */
    #[Api(optional: true)]
    public ?string $folder;

    /**
     * Whether to mark the file as private or not.
     *
     * If `true`, the file is marked as private and is accessible only using named transformation or signed URL.
     *
     * @var null|IsPrivateFile::* $isPrivateFile
     */
    #[Api(enum: IsPrivateFile::class, optional: true)]
    public ?string $isPrivateFile;

    /**
     * Whether to upload file as published or not.
     *
     * If `false`, the file is marked as unpublished, which restricts access to the file only via the media library. Files in draft or unpublished state can only be publicly accessed after being published.
     *
     * The option to upload in draft state is only available in custom enterprise pricing plans.
     *
     * @var null|IsPublished::* $isPublished
     */
    #[Api(enum: IsPublished::class, optional: true)]
    public ?string $isPublished;

    /**
     * If set to `true` and a file already exists at the exact location, its AITags will be removed. Set `overwriteAITags` to `false` to preserve AITags.
     *
     * @var null|OverwriteAITags::* $overwriteAITags
     */
    #[Api(enum: OverwriteAITags::class, optional: true)]
    public ?string $overwriteAITags;

    /**
     * If the request does not have `customMetadata`, and a file already exists at the exact location, existing customMetadata will be removed.
     *
     * @var null|OverwriteCustomMetadata::* $overwriteCustomMetadata
     */
    #[Api(enum: OverwriteCustomMetadata::class, optional: true)]
    public ?string $overwriteCustomMetadata;

    /**
     * If `false` and `useUniqueFileName` is also `false`, and a file already exists at the exact location, upload API will return an error immediately.
     */
    #[Api(optional: true)]
    public ?string $overwriteFile;

    /**
     * If the request does not have `tags`, and a file already exists at the exact location, existing tags will be removed.
     *
     * @var null|OverwriteTags::* $overwriteTags
     */
    #[Api(enum: OverwriteTags::class, optional: true)]
    public ?string $overwriteTags;

    /**
     * Comma-separated values of the fields that you want the API to return in the response.
     *
     * For example, set the value of this field to `tags,customCoordinates,isPrivateFile` to get the value of `tags`, `customCoordinates`, and `isPrivateFile` in the response.
     *
     *
     * Accepts combination of `tags`, `customCoordinates`, `isPrivateFile`, `embeddedMetadata`, `isPublished`, `customMetadata`, and `metadata`.
     */
    #[Api(optional: true)]
    public ?string $responseFields;

    /**
     * Set the tags while uploading the file.
     *
     * Comma-separated value of tags in the format `tag1,tag2,tag3`. The maximum length of all characters should not exceed 500. `%` is not allowed.
     *
     * If this field is not specified and the file is overwritten then the tags will be removed.
     */
    #[Api(optional: true)]
    public ?string $tags;

    /**
     * Stringified JSON object with properties for pre and post transformations:
     *
     * `pre` - Accepts a "string" containing a valid transformation used for requesting a pre-transformation for an image or a video file.
     *
     * `post` - Accepts an array of objects with properties:
     *   - `type`: One of `transformation`, `gif-to-video`, `thumbnail`, or `abs` (Adaptive bitrate streaming).
     *   - `value`: A "string" corresponding to the required transformation. Required if `type` is `transformation` or `abs`. Optional if `type` is `gif-to-video` or `thumbnail`.
     *   - `protocol`: Either `hls` or `dash`, applicable only if `type` is `abs`.
     *
     * Read more about [Adaptive bitrate streaming (ABS)](/docs/adaptive-bitrate-streaming).
     */
    #[Api(optional: true)]
    public ?string $transformation;

    /**
     * Whether to use a unique filename for this file or not.
     *
     * If `true`, ImageKit.io will add a unique suffix to the filename parameter to get a unique filename.
     *
     * If `false`, then the image is uploaded with the provided filename parameter, and any existing file with the same name is replaced.
     *
     * @var null|UseUniqueFileName::* $useUniqueFileName
     */
    #[Api(enum: UseUniqueFileName::class, optional: true)]
    public ?string $useUniqueFileName;

    /**
     * The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     */
    #[Api('webhookUrl', optional: true)]
    public ?string $webhookURL;

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
     * @param null|IsPrivateFile::* $isPrivateFile
     * @param null|IsPublished::* $isPublished
     * @param null|OverwriteAITags::* $overwriteAITags
     * @param null|OverwriteCustomMetadata::* $overwriteCustomMetadata
     * @param null|OverwriteTags::* $overwriteTags
     * @param null|UseUniqueFileName::* $useUniqueFileName
     */
    public static function from(
        string $file,
        string $fileName,
        ?string $token = null,
        ?string $checks = null,
        ?string $customCoordinates = null,
        ?string $customMetadata = null,
        ?string $extensions = null,
        ?string $folder = null,
        ?string $isPrivateFile = null,
        ?string $isPublished = null,
        ?string $overwriteAITags = null,
        ?string $overwriteCustomMetadata = null,
        ?string $overwriteFile = null,
        ?string $overwriteTags = null,
        ?string $responseFields = null,
        ?string $tags = null,
        ?string $transformation = null,
        ?string $useUniqueFileName = null,
        ?string $webhookURL = null,
    ): self {
        $obj = new self;

        $obj->file = $file;
        $obj->fileName = $fileName;

        null !== $token && $obj->token = $token;
        null !== $checks && $obj->checks = $checks;
        null !== $customCoordinates && $obj->customCoordinates = $customCoordinates;
        null !== $customMetadata && $obj->customMetadata = $customMetadata;
        null !== $extensions && $obj->extensions = $extensions;
        null !== $folder && $obj->folder = $folder;
        null !== $isPrivateFile && $obj->isPrivateFile = $isPrivateFile;
        null !== $isPublished && $obj->isPublished = $isPublished;
        null !== $overwriteAITags && $obj->overwriteAITags = $overwriteAITags;
        null !== $overwriteCustomMetadata && $obj->overwriteCustomMetadata = $overwriteCustomMetadata;
        null !== $overwriteFile && $obj->overwriteFile = $overwriteFile;
        null !== $overwriteTags && $obj->overwriteTags = $overwriteTags;
        null !== $responseFields && $obj->responseFields = $responseFields;
        null !== $tags && $obj->tags = $tags;
        null !== $transformation && $obj->transformation = $transformation;
        null !== $useUniqueFileName && $obj->useUniqueFileName = $useUniqueFileName;
        null !== $webhookURL && $obj->webhookURL = $webhookURL;

        return $obj;
    }

    /**
     * Pass the HTTP URL or base64 string. When passing a URL in the file parameter, please ensure that our servers can access the URL. In case ImageKit is unable to download the file from the specified URL, a `400` error response is returned. This will also result in a `400` error if the file download request is aborted if response headers are not received in 8 seconds.
     */
    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * The name with which the file has to be uploaded.
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * This is the client-generated JSON Web Token (JWT). The ImageKit.io server uses it to authenticate and check that the upload request parameters have not been tampered with after the token has been generated. Learn how to create the token on the page below. This field is only required for authentication when uploading a file from the client side.
     *
     * **Note**: Sending a JWT that has been used in the past will result in a validation error. Even if your previous request resulted in an error, you should always send a new token.
     *
     *
     * **⚠️Warning**: JWT must be generated on the server-side because it is generated using your account's private API key. This field is required for authentication when uploading a file from the client-side.
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Server-side checks to run on the asset.
     * Read more about [Upload API checks](/docs/api-reference/upload-file/upload-file-v2#upload-api-checks).
     */
    public function setChecks(string $checks): self
    {
        $this->checks = $checks;

        return $this;
    }

    /**
     * Define an important area in the image. This is only relevant for image type files.
     *
     *   - To be passed as a string with the x and y coordinates of the top-left corner, and width and height of the area of interest in the format `x,y,width,height`. For example - `10,10,100,100`
     *   - Can be used with fo-customtransformation.
     *   - If this field is not specified and the file is overwritten, then customCoordinates will be removed.
     */
    public function setCustomCoordinates(string $customCoordinates): self
    {
        $this->customCoordinates = $customCoordinates;

        return $this;
    }

    /**
     * Stringified JSON key-value data to be associated with the asset.
     */
    public function setCustomMetadata(string $customMetadata): self
    {
        $this->customMetadata = $customMetadata;

        return $this;
    }

    /**
     * Stringified JSON object with an array of extensions to be applied to the image. Refer to extensions schema in [update file API request body](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#request-body).
     */
    public function setExtensions(string $extensions): self
    {
        $this->extensions = $extensions;

        return $this;
    }

    /**
     * The folder path in which the image has to be uploaded. If the folder(s) didn't exist before, a new folder(s) is created. Using multiple `/` creates a nested folder.
     */
    public function setFolder(string $folder): self
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Whether to mark the file as private or not.
     *
     * If `true`, the file is marked as private and is accessible only using named transformation or signed URL.
     *
     * @param IsPrivateFile::* $isPrivateFile
     */
    public function setIsPrivateFile(string $isPrivateFile): self
    {
        $this->isPrivateFile = $isPrivateFile;

        return $this;
    }

    /**
     * Whether to upload file as published or not.
     *
     * If `false`, the file is marked as unpublished, which restricts access to the file only via the media library. Files in draft or unpublished state can only be publicly accessed after being published.
     *
     * The option to upload in draft state is only available in custom enterprise pricing plans.
     *
     * @param IsPublished::* $isPublished
     */
    public function setIsPublished(string $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * If set to `true` and a file already exists at the exact location, its AITags will be removed. Set `overwriteAITags` to `false` to preserve AITags.
     *
     * @param OverwriteAITags::* $overwriteAITags
     */
    public function setOverwriteAITags(string $overwriteAITags): self
    {
        $this->overwriteAITags = $overwriteAITags;

        return $this;
    }

    /**
     * If the request does not have `customMetadata`, and a file already exists at the exact location, existing customMetadata will be removed.
     *
     * @param OverwriteCustomMetadata::* $overwriteCustomMetadata
     */
    public function setOverwriteCustomMetadata(
        string $overwriteCustomMetadata
    ): self {
        $this->overwriteCustomMetadata = $overwriteCustomMetadata;

        return $this;
    }

    /**
     * If `false` and `useUniqueFileName` is also `false`, and a file already exists at the exact location, upload API will return an error immediately.
     */
    public function setOverwriteFile(string $overwriteFile): self
    {
        $this->overwriteFile = $overwriteFile;

        return $this;
    }

    /**
     * If the request does not have `tags`, and a file already exists at the exact location, existing tags will be removed.
     *
     * @param OverwriteTags::* $overwriteTags
     */
    public function setOverwriteTags(string $overwriteTags): self
    {
        $this->overwriteTags = $overwriteTags;

        return $this;
    }

    /**
     * Comma-separated values of the fields that you want the API to return in the response.
     *
     * For example, set the value of this field to `tags,customCoordinates,isPrivateFile` to get the value of `tags`, `customCoordinates`, and `isPrivateFile` in the response.
     *
     *
     * Accepts combination of `tags`, `customCoordinates`, `isPrivateFile`, `embeddedMetadata`, `isPublished`, `customMetadata`, and `metadata`.
     */
    public function setResponseFields(string $responseFields): self
    {
        $this->responseFields = $responseFields;

        return $this;
    }

    /**
     * Set the tags while uploading the file.
     *
     * Comma-separated value of tags in the format `tag1,tag2,tag3`. The maximum length of all characters should not exceed 500. `%` is not allowed.
     *
     * If this field is not specified and the file is overwritten then the tags will be removed.
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Stringified JSON object with properties for pre and post transformations:
     *
     * `pre` - Accepts a "string" containing a valid transformation used for requesting a pre-transformation for an image or a video file.
     *
     * `post` - Accepts an array of objects with properties:
     *   - `type`: One of `transformation`, `gif-to-video`, `thumbnail`, or `abs` (Adaptive bitrate streaming).
     *   - `value`: A "string" corresponding to the required transformation. Required if `type` is `transformation` or `abs`. Optional if `type` is `gif-to-video` or `thumbnail`.
     *   - `protocol`: Either `hls` or `dash`, applicable only if `type` is `abs`.
     *
     * Read more about [Adaptive bitrate streaming (ABS)](/docs/adaptive-bitrate-streaming).
     */
    public function setTransformation(string $transformation): self
    {
        $this->transformation = $transformation;

        return $this;
    }

    /**
     * Whether to use a unique filename for this file or not.
     *
     * If `true`, ImageKit.io will add a unique suffix to the filename parameter to get a unique filename.
     *
     * If `false`, then the image is uploaded with the provided filename parameter, and any existing file with the same name is replaced.
     *
     * @param UseUniqueFileName::* $useUniqueFileName
     */
    public function setUseUniqueFileName(string $useUniqueFileName): self
    {
        $this->useUniqueFileName = $useUniqueFileName;

        return $this;
    }

    /**
     * The final status of extensions after they have completed execution will be delivered to this endpoint as a POST request. [Learn more](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#webhook-payload-structure) about the webhook payload structure.
     */
    public function setWebhookURL(string $webhookURL): self
    {
        $this->webhookURL = $webhookURL;

        return $this;
    }
}
