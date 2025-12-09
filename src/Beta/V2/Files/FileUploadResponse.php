<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files;

use Imagekit\Beta\V2\Files\FileUploadResponse\AITag;
use Imagekit\Beta\V2\Files\FileUploadResponse\ExtensionStatus;
use Imagekit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\AIAutoDescription;
use Imagekit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\AwsAutoTagging;
use Imagekit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\GoogleAutoTagging;
use Imagekit\Beta\V2\Files\FileUploadResponse\ExtensionStatus\RemoveBg;
use Imagekit\Beta\V2\Files\FileUploadResponse\SelectedFieldsSchema;
use Imagekit\Beta\V2\Files\FileUploadResponse\SelectedFieldsSchema\Type;
use Imagekit\Beta\V2\Files\FileUploadResponse\VersionInfo;
use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Files\Metadata;
use Imagekit\Files\Metadata\Exif;

/**
 * Object containing details of a successful upload.
 *
 * @phpstan-type FileUploadResponseShape = array{
 *   aiTags?: list<AITag>|null,
 *   audioCodec?: string|null,
 *   bitRate?: int|null,
 *   customCoordinates?: string|null,
 *   customMetadata?: array<string,mixed>|null,
 *   description?: string|null,
 *   duration?: int|null,
 *   embeddedMetadata?: array<string,mixed>|null,
 *   extensionStatus?: ExtensionStatus|null,
 *   fileID?: string|null,
 *   filePath?: string|null,
 *   fileType?: string|null,
 *   height?: float|null,
 *   isPrivateFile?: bool|null,
 *   isPublished?: bool|null,
 *   metadata?: Metadata|null,
 *   name?: string|null,
 *   selectedFieldsSchema?: array<string,SelectedFieldsSchema>|null,
 *   size?: float|null,
 *   tags?: list<string>|null,
 *   thumbnailURL?: string|null,
 *   url?: string|null,
 *   versionInfo?: VersionInfo|null,
 *   videoCodec?: string|null,
 *   width?: float|null,
 * }
 */
final class FileUploadResponse implements BaseModel
{
    /** @use SdkModel<FileUploadResponseShape> */
    use SdkModel;

    /**
     * An array of tags assigned to the uploaded file by auto tagging.
     *
     * @var list<AITag>|null $aiTags
     */
    #[Optional('AITags', list: AITag::class, nullable: true)]
    public ?array $aiTags;

    /**
     * The audio codec used in the video (only for video).
     */
    #[Optional]
    public ?string $audioCodec;

    /**
     * The bit rate of the video in kbps (only for video).
     */
    #[Optional]
    public ?int $bitRate;

    /**
     * Value of custom coordinates associated with the image in the format `x,y,width,height`. If `customCoordinates` are not defined, then it is `null`. Send `customCoordinates` in `responseFields` in API request to get the value of this field.
     */
    #[Optional(nullable: true)]
    public ?string $customCoordinates;

    /**
     * A key-value data associated with the asset. Use `responseField` in API request to get `customMetadata` in the upload API response. Before setting any custom metadata on an asset, you have to create the field using custom metadata fields API. Send `customMetadata` in `responseFields` in API request to get the value of this field.
     *
     * @var array<string,mixed>|null $customMetadata
     */
    #[Optional(map: 'mixed')]
    public ?array $customMetadata;

    /**
     * Optional text to describe the contents of the file. Can be set by the user or the ai-auto-description extension.
     */
    #[Optional]
    public ?string $description;

    /**
     * The duration of the video in seconds (only for video).
     */
    #[Optional]
    public ?int $duration;

    /**
     * Consolidated embedded metadata associated with the file. It includes exif, iptc, and xmp data. Send `embeddedMetadata` in `responseFields` in API request to get embeddedMetadata in the upload API response.
     *
     * @var array<string,mixed>|null $embeddedMetadata
     */
    #[Optional(map: 'mixed')]
    public ?array $embeddedMetadata;

    /**
     * Extension names with their processing status at the time of completion of the request. It could have one of the following status values:
     *
     * `success`: The extension has been successfully applied.
     * `failed`: The extension has failed and will not be retried.
     * `pending`: The extension will finish processing in some time. On completion, the final status (success / failed) will be sent to the `webhookUrl` provided.
     *
     * If no extension was requested, then this parameter is not returned.
     */
    #[Optional]
    public ?ExtensionStatus $extensionStatus;

    /**
     * Unique fileId. Store this fileld in your database, as this will be used to perform update action on this file.
     */
    #[Optional('fileId')]
    public ?string $fileID;

    /**
     * The relative path of the file in the media library e.g. `/marketing-assets/new-banner.jpg`.
     */
    #[Optional]
    public ?string $filePath;

    /**
     * Type of the uploaded file. Possible values are `image`, `non-image`.
     */
    #[Optional]
    public ?string $fileType;

    /**
     * Height of the image in pixels (Only for images).
     */
    #[Optional]
    public ?float $height;

    /**
     * Is the file marked as private. It can be either `true` or `false`. Send `isPrivateFile` in `responseFields` in API request to get the value of this field.
     */
    #[Optional]
    public ?bool $isPrivateFile;

    /**
     * Is the file published or in draft state. It can be either `true` or `false`. Send `isPublished` in `responseFields` in API request to get the value of this field.
     */
    #[Optional]
    public ?bool $isPublished;

    /**
     * Legacy metadata. Send `metadata` in `responseFields` in API request to get metadata in the upload API response.
     */
    #[Optional]
    public ?Metadata $metadata;

    /**
     * Name of the asset.
     */
    #[Optional]
    public ?string $name;

    /**
     * This field is included in the response only if the Path policy feature is available in the plan.
     * It contains schema definitions for the custom metadata fields selected for the specified file path.
     * Field selection can only be done when the Path policy feature is enabled.
     *
     * Keys are the names of the custom metadata fields; the value object has details about the custom metadata schema.
     *
     * @var array<string,SelectedFieldsSchema>|null $selectedFieldsSchema
     */
    #[Optional(map: SelectedFieldsSchema::class)]
    public ?array $selectedFieldsSchema;

    /**
     * Size of the image file in Bytes.
     */
    #[Optional]
    public ?float $size;

    /**
     * The array of tags associated with the asset. If no tags are set, it will be `null`. Send `tags` in `responseFields` in API request to get the value of this field.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $tags;

    /**
     * In the case of an image, a small thumbnail URL.
     */
    #[Optional('thumbnailUrl')]
    public ?string $thumbnailURL;

    /**
     * A publicly accessible URL of the file.
     */
    #[Optional]
    public ?string $url;

    /**
     * An object containing the file or file version's `id` (versionId) and `name`.
     */
    #[Optional]
    public ?VersionInfo $versionInfo;

    /**
     * The video codec used in the video (only for video).
     */
    #[Optional]
    public ?string $videoCodec;

    /**
     * Width of the image in pixels (Only for Images).
     */
    #[Optional]
    public ?float $width;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<AITag|array{
     *   confidence?: float|null, name?: string|null, source?: string|null
     * }>|null $aiTags
     * @param array<string,mixed> $customMetadata
     * @param array<string,mixed> $embeddedMetadata
     * @param ExtensionStatus|array{
     *   aiAutoDescription?: value-of<AIAutoDescription>|null,
     *   awsAutoTagging?: value-of<AwsAutoTagging>|null,
     *   googleAutoTagging?: value-of<GoogleAutoTagging>|null,
     *   removeBg?: value-of<RemoveBg>|null,
     * } $extensionStatus
     * @param Metadata|array{
     *   audioCodec?: string|null,
     *   bitRate?: int|null,
     *   density?: int|null,
     *   duration?: int|null,
     *   exif?: Exif|null,
     *   format?: string|null,
     *   hasColorProfile?: bool|null,
     *   hasTransparency?: bool|null,
     *   height?: int|null,
     *   pHash?: string|null,
     *   quality?: int|null,
     *   size?: int|null,
     *   videoCodec?: string|null,
     *   width?: int|null,
     * } $metadata
     * @param array<string,SelectedFieldsSchema|array{
     *   type: value-of<Type>,
     *   defaultValue?: string|float|bool|list<string|float|bool>|null,
     *   isValueRequired?: bool|null,
     *   maxLength?: float|null,
     *   maxValue?: string|float|null,
     *   minLength?: float|null,
     *   minValue?: string|float|null,
     *   readOnly?: bool|null,
     *   selectOptions?: list<string|float|bool>|null,
     *   selectOptionsTruncated?: bool|null,
     * }> $selectedFieldsSchema
     * @param list<string>|null $tags
     * @param VersionInfo|array{id?: string|null, name?: string|null} $versionInfo
     */
    public static function with(
        ?array $aiTags = null,
        ?string $audioCodec = null,
        ?int $bitRate = null,
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?string $description = null,
        ?int $duration = null,
        ?array $embeddedMetadata = null,
        ExtensionStatus|array|null $extensionStatus = null,
        ?string $fileID = null,
        ?string $filePath = null,
        ?string $fileType = null,
        ?float $height = null,
        ?bool $isPrivateFile = null,
        ?bool $isPublished = null,
        Metadata|array|null $metadata = null,
        ?string $name = null,
        ?array $selectedFieldsSchema = null,
        ?float $size = null,
        ?array $tags = null,
        ?string $thumbnailURL = null,
        ?string $url = null,
        VersionInfo|array|null $versionInfo = null,
        ?string $videoCodec = null,
        ?float $width = null,
    ): self {
        $obj = new self;

        null !== $aiTags && $obj['aiTags'] = $aiTags;
        null !== $audioCodec && $obj['audioCodec'] = $audioCodec;
        null !== $bitRate && $obj['bitRate'] = $bitRate;
        null !== $customCoordinates && $obj['customCoordinates'] = $customCoordinates;
        null !== $customMetadata && $obj['customMetadata'] = $customMetadata;
        null !== $description && $obj['description'] = $description;
        null !== $duration && $obj['duration'] = $duration;
        null !== $embeddedMetadata && $obj['embeddedMetadata'] = $embeddedMetadata;
        null !== $extensionStatus && $obj['extensionStatus'] = $extensionStatus;
        null !== $fileID && $obj['fileID'] = $fileID;
        null !== $filePath && $obj['filePath'] = $filePath;
        null !== $fileType && $obj['fileType'] = $fileType;
        null !== $height && $obj['height'] = $height;
        null !== $isPrivateFile && $obj['isPrivateFile'] = $isPrivateFile;
        null !== $isPublished && $obj['isPublished'] = $isPublished;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $name && $obj['name'] = $name;
        null !== $selectedFieldsSchema && $obj['selectedFieldsSchema'] = $selectedFieldsSchema;
        null !== $size && $obj['size'] = $size;
        null !== $tags && $obj['tags'] = $tags;
        null !== $thumbnailURL && $obj['thumbnailURL'] = $thumbnailURL;
        null !== $url && $obj['url'] = $url;
        null !== $versionInfo && $obj['versionInfo'] = $versionInfo;
        null !== $videoCodec && $obj['videoCodec'] = $videoCodec;
        null !== $width && $obj['width'] = $width;

        return $obj;
    }

    /**
     * An array of tags assigned to the uploaded file by auto tagging.
     *
     * @param list<AITag|array{
     *   confidence?: float|null, name?: string|null, source?: string|null
     * }>|null $aiTags
     */
    public function withAITags(?array $aiTags): self
    {
        $obj = clone $this;
        $obj['aiTags'] = $aiTags;

        return $obj;
    }

    /**
     * The audio codec used in the video (only for video).
     */
    public function withAudioCodec(string $audioCodec): self
    {
        $obj = clone $this;
        $obj['audioCodec'] = $audioCodec;

        return $obj;
    }

    /**
     * The bit rate of the video in kbps (only for video).
     */
    public function withBitRate(int $bitRate): self
    {
        $obj = clone $this;
        $obj['bitRate'] = $bitRate;

        return $obj;
    }

    /**
     * Value of custom coordinates associated with the image in the format `x,y,width,height`. If `customCoordinates` are not defined, then it is `null`. Send `customCoordinates` in `responseFields` in API request to get the value of this field.
     */
    public function withCustomCoordinates(?string $customCoordinates): self
    {
        $obj = clone $this;
        $obj['customCoordinates'] = $customCoordinates;

        return $obj;
    }

    /**
     * A key-value data associated with the asset. Use `responseField` in API request to get `customMetadata` in the upload API response. Before setting any custom metadata on an asset, you have to create the field using custom metadata fields API. Send `customMetadata` in `responseFields` in API request to get the value of this field.
     *
     * @param array<string,mixed> $customMetadata
     */
    public function withCustomMetadata(array $customMetadata): self
    {
        $obj = clone $this;
        $obj['customMetadata'] = $customMetadata;

        return $obj;
    }

    /**
     * Optional text to describe the contents of the file. Can be set by the user or the ai-auto-description extension.
     */
    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * The duration of the video in seconds (only for video).
     */
    public function withDuration(int $duration): self
    {
        $obj = clone $this;
        $obj['duration'] = $duration;

        return $obj;
    }

    /**
     * Consolidated embedded metadata associated with the file. It includes exif, iptc, and xmp data. Send `embeddedMetadata` in `responseFields` in API request to get embeddedMetadata in the upload API response.
     *
     * @param array<string,mixed> $embeddedMetadata
     */
    public function withEmbeddedMetadata(array $embeddedMetadata): self
    {
        $obj = clone $this;
        $obj['embeddedMetadata'] = $embeddedMetadata;

        return $obj;
    }

    /**
     * Extension names with their processing status at the time of completion of the request. It could have one of the following status values:
     *
     * `success`: The extension has been successfully applied.
     * `failed`: The extension has failed and will not be retried.
     * `pending`: The extension will finish processing in some time. On completion, the final status (success / failed) will be sent to the `webhookUrl` provided.
     *
     * If no extension was requested, then this parameter is not returned.
     *
     * @param ExtensionStatus|array{
     *   aiAutoDescription?: value-of<AIAutoDescription>|null,
     *   awsAutoTagging?: value-of<AwsAutoTagging>|null,
     *   googleAutoTagging?: value-of<GoogleAutoTagging>|null,
     *   removeBg?: value-of<RemoveBg>|null,
     * } $extensionStatus
     */
    public function withExtensionStatus(
        ExtensionStatus|array $extensionStatus
    ): self {
        $obj = clone $this;
        $obj['extensionStatus'] = $extensionStatus;

        return $obj;
    }

    /**
     * Unique fileId. Store this fileld in your database, as this will be used to perform update action on this file.
     */
    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj['fileID'] = $fileID;

        return $obj;
    }

    /**
     * The relative path of the file in the media library e.g. `/marketing-assets/new-banner.jpg`.
     */
    public function withFilePath(string $filePath): self
    {
        $obj = clone $this;
        $obj['filePath'] = $filePath;

        return $obj;
    }

    /**
     * Type of the uploaded file. Possible values are `image`, `non-image`.
     */
    public function withFileType(string $fileType): self
    {
        $obj = clone $this;
        $obj['fileType'] = $fileType;

        return $obj;
    }

    /**
     * Height of the image in pixels (Only for images).
     */
    public function withHeight(float $height): self
    {
        $obj = clone $this;
        $obj['height'] = $height;

        return $obj;
    }

    /**
     * Is the file marked as private. It can be either `true` or `false`. Send `isPrivateFile` in `responseFields` in API request to get the value of this field.
     */
    public function withIsPrivateFile(bool $isPrivateFile): self
    {
        $obj = clone $this;
        $obj['isPrivateFile'] = $isPrivateFile;

        return $obj;
    }

    /**
     * Is the file published or in draft state. It can be either `true` or `false`. Send `isPublished` in `responseFields` in API request to get the value of this field.
     */
    public function withIsPublished(bool $isPublished): self
    {
        $obj = clone $this;
        $obj['isPublished'] = $isPublished;

        return $obj;
    }

    /**
     * Legacy metadata. Send `metadata` in `responseFields` in API request to get metadata in the upload API response.
     *
     * @param Metadata|array{
     *   audioCodec?: string|null,
     *   bitRate?: int|null,
     *   density?: int|null,
     *   duration?: int|null,
     *   exif?: Exif|null,
     *   format?: string|null,
     *   hasColorProfile?: bool|null,
     *   hasTransparency?: bool|null,
     *   height?: int|null,
     *   pHash?: string|null,
     *   quality?: int|null,
     *   size?: int|null,
     *   videoCodec?: string|null,
     *   width?: int|null,
     * } $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * Name of the asset.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * This field is included in the response only if the Path policy feature is available in the plan.
     * It contains schema definitions for the custom metadata fields selected for the specified file path.
     * Field selection can only be done when the Path policy feature is enabled.
     *
     * Keys are the names of the custom metadata fields; the value object has details about the custom metadata schema.
     *
     * @param array<string,SelectedFieldsSchema|array{
     *   type: value-of<Type>,
     *   defaultValue?: string|float|bool|list<string|float|bool>|null,
     *   isValueRequired?: bool|null,
     *   maxLength?: float|null,
     *   maxValue?: string|float|null,
     *   minLength?: float|null,
     *   minValue?: string|float|null,
     *   readOnly?: bool|null,
     *   selectOptions?: list<string|float|bool>|null,
     *   selectOptionsTruncated?: bool|null,
     * }> $selectedFieldsSchema
     */
    public function withSelectedFieldsSchema(array $selectedFieldsSchema): self
    {
        $obj = clone $this;
        $obj['selectedFieldsSchema'] = $selectedFieldsSchema;

        return $obj;
    }

    /**
     * Size of the image file in Bytes.
     */
    public function withSize(float $size): self
    {
        $obj = clone $this;
        $obj['size'] = $size;

        return $obj;
    }

    /**
     * The array of tags associated with the asset. If no tags are set, it will be `null`. Send `tags` in `responseFields` in API request to get the value of this field.
     *
     * @param list<string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $obj = clone $this;
        $obj['tags'] = $tags;

        return $obj;
    }

    /**
     * In the case of an image, a small thumbnail URL.
     */
    public function withThumbnailURL(string $thumbnailURL): self
    {
        $obj = clone $this;
        $obj['thumbnailURL'] = $thumbnailURL;

        return $obj;
    }

    /**
     * A publicly accessible URL of the file.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }

    /**
     * An object containing the file or file version's `id` (versionId) and `name`.
     *
     * @param VersionInfo|array{id?: string|null, name?: string|null} $versionInfo
     */
    public function withVersionInfo(VersionInfo|array $versionInfo): self
    {
        $obj = clone $this;
        $obj['versionInfo'] = $versionInfo;

        return $obj;
    }

    /**
     * The video codec used in the video (only for video).
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $obj = clone $this;
        $obj['videoCodec'] = $videoCodec;

        return $obj;
    }

    /**
     * Width of the image in pixels (Only for Images).
     */
    public function withWidth(float $width): self
    {
        $obj = clone $this;
        $obj['width'] = $width;

        return $obj;
    }
}
