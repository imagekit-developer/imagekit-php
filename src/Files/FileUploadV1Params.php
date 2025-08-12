<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\FileUploadV1Params\IsPrivateFile;
use ImageKit\Files\FileUploadV1Params\IsPublished;
use ImageKit\Files\FileUploadV1Params\OverwriteAITags;
use ImageKit\Files\FileUploadV1Params\OverwriteCustomMetadata;
use ImageKit\Files\FileUploadV1Params\OverwriteTags;
use ImageKit\Files\FileUploadV1Params\UseUniqueFileName;

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
 * @phpstan-type upload_v1_params = array{
 *   file: string,
 *   fileName: string,
 *   token?: string,
 *   checks?: string,
 *   customCoordinates?: string,
 *   customMetadata?: string,
 *   expire?: string,
 *   extensions?: string,
 *   folder?: string,
 *   isPrivateFile?: IsPrivateFile::*,
 *   isPublished?: IsPublished::*,
 *   overwriteAITags?: OverwriteAITags::*,
 *   overwriteCustomMetadata?: OverwriteCustomMetadata::*,
 *   overwriteFile?: string,
 *   overwriteTags?: OverwriteTags::*,
 *   publicKey?: string,
 *   responseFields?: string,
 *   signature?: string,
 *   tags?: string,
 *   transformation?: string,
 *   useUniqueFileName?: UseUniqueFileName::*,
 *   webhookURL?: string,
 * }
 */
final class FileUploadV1Params implements BaseModel
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
     * Stringified JSON key-value data to be associated with the asset.
     */
    #[Api(optional: true)]
    public ?string $customMetadata;

    /**
     * The time until your signature is valid. It must be a [Unix time](https://en.wikipedia.org/wiki/Unix_time) in less than 1 hour into the future. It should be in seconds. This field is only required for authentication when uploading a file from the client side.
     */
    #[Api(optional: true)]
    public ?string $expire;

    /**
     * Stringified JSON object with an array of extensions to be applied to the image. Refer to extensions schema in [update file API request body](/docs/api-reference/digital-asset-management-dam/managing-assets/update-file-details#request-body).
     */
    #[Api(optional: true)]
    public ?string $extensions;

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
     * Your ImageKit.io public key. This field is only required for authentication when uploading a file from the client side.
     */
    #[Api(optional: true)]
    public ?string $publicKey;

    /**
     * Comma-separated values of the fields that you want the API to return in the response.
     *
     * For example, set the value of this field to `tags,customCoordinates,isPrivateFile` to get the value of `tags`, `customCoordinates`, and `isPrivateFile` in the response.
     *
     * Accepts combination of `tags`, `customCoordinates`, `isPrivateFile`, `embeddedMetadata`, `isPublished`, `customMetadata`, and `metadata`.
     */
    #[Api(optional: true)]
    public ?string $responseFields;

    /**
     * HMAC-SHA1 digest of the token+expire using your ImageKit.io private API key as a key. Learn how to create a signature on the page below. This should be in lowercase.
     *
     * Signature must be calculated on the server-side. This field is only required for authentication when uploading a file from the client side.
     */
    #[Api(optional: true)]
    public ?string $signature;

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
    public static function new(
        string $file,
        string $fileName,
        ?string $token = null,
        ?string $checks = null,
        ?string $customCoordinates = null,
        ?string $customMetadata = null,
        ?string $expire = null,
        ?string $extensions = null,
        ?string $folder = null,
        ?string $isPrivateFile = null,
        ?string $isPublished = null,
        ?string $overwriteAITags = null,
        ?string $overwriteCustomMetadata = null,
        ?string $overwriteFile = null,
        ?string $overwriteTags = null,
        ?string $publicKey = null,
        ?string $responseFields = null,
        ?string $signature = null,
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
}
