<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPreTransformSuccessEvent;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Files\Metadata;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\AITag;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\ExtensionStatus;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\SelectedFieldsSchema;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\VersionInfo;

/**
 * Object containing details of a successful upload.
 *
 * @phpstan-import-type AITagShape from \Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\AITag
 * @phpstan-import-type ExtensionStatusShape from \Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\ExtensionStatus
 * @phpstan-import-type MetadataShape from \Imagekit\Files\Metadata
 * @phpstan-import-type SelectedFieldsSchemaShape from \Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\SelectedFieldsSchema
 * @phpstan-import-type VersionInfoShape from \Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\VersionInfo
 *
 * @phpstan-type DataShape = array{
 *   aiTags?: list<AITagShape>|null,
 *   audioCodec?: string|null,
 *   bitRate?: int|null,
 *   customCoordinates?: string|null,
 *   customMetadata?: array<string,mixed>|null,
 *   description?: string|null,
 *   duration?: int|null,
 *   embeddedMetadata?: array<string,mixed>|null,
 *   extensionStatus?: null|ExtensionStatus|ExtensionStatusShape,
 *   fileID?: string|null,
 *   filePath?: string|null,
 *   fileType?: string|null,
 *   height?: float|null,
 *   isPrivateFile?: bool|null,
 *   isPublished?: bool|null,
 *   metadata?: null|Metadata|MetadataShape,
 *   name?: string|null,
 *   selectedFieldsSchema?: array<string,SelectedFieldsSchemaShape>|null,
 *   size?: float|null,
 *   tags?: list<string>|null,
 *   thumbnailURL?: string|null,
 *   url?: string|null,
 *   versionInfo?: null|VersionInfo|VersionInfoShape,
 *   videoCodec?: string|null,
 *   width?: float|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
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
     * @param list<AITagShape>|null $aiTags
     * @param array<string,mixed> $customMetadata
     * @param array<string,mixed> $embeddedMetadata
     * @param ExtensionStatusShape $extensionStatus
     * @param MetadataShape $metadata
     * @param array<string,SelectedFieldsSchemaShape> $selectedFieldsSchema
     * @param list<string>|null $tags
     * @param VersionInfoShape $versionInfo
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
        $self = new self;

        null !== $aiTags && $self['aiTags'] = $aiTags;
        null !== $audioCodec && $self['audioCodec'] = $audioCodec;
        null !== $bitRate && $self['bitRate'] = $bitRate;
        null !== $customCoordinates && $self['customCoordinates'] = $customCoordinates;
        null !== $customMetadata && $self['customMetadata'] = $customMetadata;
        null !== $description && $self['description'] = $description;
        null !== $duration && $self['duration'] = $duration;
        null !== $embeddedMetadata && $self['embeddedMetadata'] = $embeddedMetadata;
        null !== $extensionStatus && $self['extensionStatus'] = $extensionStatus;
        null !== $fileID && $self['fileID'] = $fileID;
        null !== $filePath && $self['filePath'] = $filePath;
        null !== $fileType && $self['fileType'] = $fileType;
        null !== $height && $self['height'] = $height;
        null !== $isPrivateFile && $self['isPrivateFile'] = $isPrivateFile;
        null !== $isPublished && $self['isPublished'] = $isPublished;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;
        null !== $selectedFieldsSchema && $self['selectedFieldsSchema'] = $selectedFieldsSchema;
        null !== $size && $self['size'] = $size;
        null !== $tags && $self['tags'] = $tags;
        null !== $thumbnailURL && $self['thumbnailURL'] = $thumbnailURL;
        null !== $url && $self['url'] = $url;
        null !== $versionInfo && $self['versionInfo'] = $versionInfo;
        null !== $videoCodec && $self['videoCodec'] = $videoCodec;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * An array of tags assigned to the uploaded file by auto tagging.
     *
     * @param list<AITagShape>|null $aiTags
     */
    public function withAITags(?array $aiTags): self
    {
        $self = clone $this;
        $self['aiTags'] = $aiTags;

        return $self;
    }

    /**
     * The audio codec used in the video (only for video).
     */
    public function withAudioCodec(string $audioCodec): self
    {
        $self = clone $this;
        $self['audioCodec'] = $audioCodec;

        return $self;
    }

    /**
     * The bit rate of the video in kbps (only for video).
     */
    public function withBitRate(int $bitRate): self
    {
        $self = clone $this;
        $self['bitRate'] = $bitRate;

        return $self;
    }

    /**
     * Value of custom coordinates associated with the image in the format `x,y,width,height`. If `customCoordinates` are not defined, then it is `null`. Send `customCoordinates` in `responseFields` in API request to get the value of this field.
     */
    public function withCustomCoordinates(?string $customCoordinates): self
    {
        $self = clone $this;
        $self['customCoordinates'] = $customCoordinates;

        return $self;
    }

    /**
     * A key-value data associated with the asset. Use `responseField` in API request to get `customMetadata` in the upload API response. Before setting any custom metadata on an asset, you have to create the field using custom metadata fields API. Send `customMetadata` in `responseFields` in API request to get the value of this field.
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
     * Optional text to describe the contents of the file. Can be set by the user or the ai-auto-description extension.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The duration of the video in seconds (only for video).
     */
    public function withDuration(int $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Consolidated embedded metadata associated with the file. It includes exif, iptc, and xmp data. Send `embeddedMetadata` in `responseFields` in API request to get embeddedMetadata in the upload API response.
     *
     * @param array<string,mixed> $embeddedMetadata
     */
    public function withEmbeddedMetadata(array $embeddedMetadata): self
    {
        $self = clone $this;
        $self['embeddedMetadata'] = $embeddedMetadata;

        return $self;
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
     * @param ExtensionStatusShape $extensionStatus
     */
    public function withExtensionStatus(
        ExtensionStatus|array $extensionStatus
    ): self {
        $self = clone $this;
        $self['extensionStatus'] = $extensionStatus;

        return $self;
    }

    /**
     * Unique fileId. Store this fileld in your database, as this will be used to perform update action on this file.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * The relative path of the file in the media library e.g. `/marketing-assets/new-banner.jpg`.
     */
    public function withFilePath(string $filePath): self
    {
        $self = clone $this;
        $self['filePath'] = $filePath;

        return $self;
    }

    /**
     * Type of the uploaded file. Possible values are `image`, `non-image`.
     */
    public function withFileType(string $fileType): self
    {
        $self = clone $this;
        $self['fileType'] = $fileType;

        return $self;
    }

    /**
     * Height of the image in pixels (Only for images).
     */
    public function withHeight(float $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Is the file marked as private. It can be either `true` or `false`. Send `isPrivateFile` in `responseFields` in API request to get the value of this field.
     */
    public function withIsPrivateFile(bool $isPrivateFile): self
    {
        $self = clone $this;
        $self['isPrivateFile'] = $isPrivateFile;

        return $self;
    }

    /**
     * Is the file published or in draft state. It can be either `true` or `false`. Send `isPublished` in `responseFields` in API request to get the value of this field.
     */
    public function withIsPublished(bool $isPublished): self
    {
        $self = clone $this;
        $self['isPublished'] = $isPublished;

        return $self;
    }

    /**
     * Legacy metadata. Send `metadata` in `responseFields` in API request to get metadata in the upload API response.
     *
     * @param MetadataShape $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Name of the asset.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * This field is included in the response only if the Path policy feature is available in the plan.
     * It contains schema definitions for the custom metadata fields selected for the specified file path.
     * Field selection can only be done when the Path policy feature is enabled.
     *
     * Keys are the names of the custom metadata fields; the value object has details about the custom metadata schema.
     *
     * @param array<string,SelectedFieldsSchemaShape> $selectedFieldsSchema
     */
    public function withSelectedFieldsSchema(array $selectedFieldsSchema): self
    {
        $self = clone $this;
        $self['selectedFieldsSchema'] = $selectedFieldsSchema;

        return $self;
    }

    /**
     * Size of the image file in Bytes.
     */
    public function withSize(float $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * The array of tags associated with the asset. If no tags are set, it will be `null`. Send `tags` in `responseFields` in API request to get the value of this field.
     *
     * @param list<string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * In the case of an image, a small thumbnail URL.
     */
    public function withThumbnailURL(string $thumbnailURL): self
    {
        $self = clone $this;
        $self['thumbnailURL'] = $thumbnailURL;

        return $self;
    }

    /**
     * A publicly accessible URL of the file.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * An object containing the file or file version's `id` (versionId) and `name`.
     *
     * @param VersionInfoShape $versionInfo
     */
    public function withVersionInfo(VersionInfo|array $versionInfo): self
    {
        $self = clone $this;
        $self['versionInfo'] = $versionInfo;

        return $self;
    }

    /**
     * The video codec used in the video (only for video).
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $self = clone $this;
        $self['videoCodec'] = $videoCodec;

        return $self;
    }

    /**
     * Width of the image in pixels (Only for Images).
     */
    public function withWidth(float $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
