<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Responses\Files\FileUploadV1Response\AITag;
use ImageKit\Responses\Files\FileUploadV1Response\EmbeddedMetadata;
use ImageKit\Responses\Files\FileUploadV1Response\ExtensionStatus;
use ImageKit\Responses\Files\FileUploadV1Response\Metadata;
use ImageKit\Responses\Files\FileUploadV1Response\VersionInfo;

/**
 * Object containing details of a successful upload.
 *
 * @phpstan-type file_upload_v1_response_alias = array{
 *   aiTags?: list<AITag>|null,
 *   audioCodec?: string,
 *   bitRate?: int,
 *   customCoordinates?: string|null,
 *   customMetadata?: mixed,
 *   duration?: int,
 *   embeddedMetadata?: EmbeddedMetadata,
 *   extensionStatus?: ExtensionStatus,
 *   fileID?: string,
 *   filePath?: string,
 *   fileType?: string,
 *   height?: float,
 *   isPrivateFile?: bool,
 *   isPublished?: bool,
 *   metadata?: Metadata,
 *   name?: string,
 *   size?: float,
 *   tags?: list<string>|null,
 *   thumbnailURL?: string,
 *   url?: string,
 *   versionInfo?: VersionInfo,
 *   videoCodec?: string,
 *   width?: float,
 * }
 */
final class FileUploadV1Response implements BaseModel
{
    use Model;

    /**
     * An array of tags assigned to the uploaded file by auto tagging.
     *
     * @var null|list<AITag> $aiTags
     */
    #[Api(
        'AITags',
        type: new ListOf(AITag::class),
        nullable: true,
        optional: true
    )]
    public ?array $aiTags;

    /**
     * The audio codec used in the video (only for video).
     */
    #[Api(optional: true)]
    public ?string $audioCodec;

    /**
     * The bit rate of the video in kbps (only for video).
     */
    #[Api(optional: true)]
    public ?int $bitRate;

    /**
     * Value of custom coordinates associated with the image in the format `x,y,width,height`. If `customCoordinates` are not defined, then it is `null`. Send `customCoordinates` in `responseFields` in API request to get the value of this field.
     */
    #[Api(optional: true)]
    public ?string $customCoordinates;

    /**
     * A key-value data associated with the asset. Use `responseField` in API request to get `customMetadata` in the upload API response. Before setting any custom metadata on an asset, you have to create the field using custom metadata fields API. Send `customMetadata` in `responseFields` in API request to get the value of this field.
     */
    #[Api(optional: true)]
    public mixed $customMetadata;

    /**
     * The duration of the video in seconds (only for video).
     */
    #[Api(optional: true)]
    public ?int $duration;

    /**
     * Consolidated embedded metadata associated with the file. It includes exif, iptc, and xmp data. Send `embeddedMetadata` in `responseFields` in API request to get embeddedMetadata in the upload API response.
     */
    #[Api(optional: true)]
    public ?EmbeddedMetadata $embeddedMetadata;

    /**
     * Extension names with their processing status at the time of completion of the request. It could have one of the following status values:
     *
     * `success`: The extension has been successfully applied.
     * `failed`: The extension has failed and will not be retried.
     * `pending`: The extension will finish processing in some time. On completion, the final status (success / failed) will be sent to the `webhookUrl` provided.
     *
     * If no extension was requested, then this parameter is not returned.
     */
    #[Api(optional: true)]
    public ?ExtensionStatus $extensionStatus;

    /**
     * Unique fileId. Store this fileld in your database, as this will be used to perform update action on this file.
     */
    #[Api('fileId', optional: true)]
    public ?string $fileID;

    /**
     * The relative path of the file in the media library e.g. `/marketing-assets/new-banner.jpg`.
     */
    #[Api(optional: true)]
    public ?string $filePath;

    /**
     * Type of the uploaded file. Possible values are `image`, `non-image`.
     */
    #[Api(optional: true)]
    public ?string $fileType;

    /**
     * Height of the image in pixels (Only for images).
     */
    #[Api(optional: true)]
    public ?float $height;

    /**
     * Is the file marked as private. It can be either `true` or `false`. Send `isPrivateFile` in `responseFields` in API request to get the value of this field.
     */
    #[Api(optional: true)]
    public ?bool $isPrivateFile;

    /**
     * Is the file published or in draft state. It can be either `true` or `false`. Send `isPublished` in `responseFields` in API request to get the value of this field.
     */
    #[Api(optional: true)]
    public ?bool $isPublished;

    /**
     * Legacy metadata. Send `metadata` in `responseFields` in API request to get metadata in the upload API response.
     */
    #[Api(optional: true)]
    public ?Metadata $metadata;

    /**
     * Name of the asset.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * Size of the image file in Bytes.
     */
    #[Api(optional: true)]
    public ?float $size;

    /**
     * The array of tags associated with the asset. If no tags are set, it will be `null`. Send `tags` in `responseFields` in API request to get the value of this field.
     *
     * @var null|list<string> $tags
     */
    #[Api(type: new ListOf('string'), nullable: true, optional: true)]
    public ?array $tags;

    /**
     * In the case of an image, a small thumbnail URL.
     */
    #[Api('thumbnailUrl', optional: true)]
    public ?string $thumbnailURL;

    /**
     * A publicly accessible URL of the file.
     */
    #[Api(optional: true)]
    public ?string $url;

    /**
     * An object containing the file or file version's `id` (versionId) and `name`.
     */
    #[Api(optional: true)]
    public ?VersionInfo $versionInfo;

    /**
     * The video codec used in the video (only for video).
     */
    #[Api(optional: true)]
    public ?string $videoCodec;

    /**
     * Width of the image in pixels (Only for Images).
     */
    #[Api(optional: true)]
    public ?float $width;

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
     * @param null|list<AITag> $aiTags
     * @param null|list<string> $tags
     */
    public static function new(
        ?array $aiTags = null,
        ?string $audioCodec = null,
        ?int $bitRate = null,
        ?string $customCoordinates = null,
        mixed $customMetadata = null,
        ?int $duration = null,
        ?EmbeddedMetadata $embeddedMetadata = null,
        ?ExtensionStatus $extensionStatus = null,
        ?string $fileID = null,
        ?string $filePath = null,
        ?string $fileType = null,
        ?float $height = null,
        ?bool $isPrivateFile = null,
        ?bool $isPublished = null,
        ?Metadata $metadata = null,
        ?string $name = null,
        ?float $size = null,
        ?array $tags = null,
        ?string $thumbnailURL = null,
        ?string $url = null,
        ?VersionInfo $versionInfo = null,
        ?string $videoCodec = null,
        ?float $width = null,
    ): self {
        $obj = new self;

        null !== $aiTags && $obj->aiTags = $aiTags;
        null !== $audioCodec && $obj->audioCodec = $audioCodec;
        null !== $bitRate && $obj->bitRate = $bitRate;
        null !== $customCoordinates && $obj->customCoordinates = $customCoordinates;
        null !== $customMetadata && $obj->customMetadata = $customMetadata;
        null !== $duration && $obj->duration = $duration;
        null !== $embeddedMetadata && $obj->embeddedMetadata = $embeddedMetadata;
        null !== $extensionStatus && $obj->extensionStatus = $extensionStatus;
        null !== $fileID && $obj->fileID = $fileID;
        null !== $filePath && $obj->filePath = $filePath;
        null !== $fileType && $obj->fileType = $fileType;
        null !== $height && $obj->height = $height;
        null !== $isPrivateFile && $obj->isPrivateFile = $isPrivateFile;
        null !== $isPublished && $obj->isPublished = $isPublished;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $name && $obj->name = $name;
        null !== $size && $obj->size = $size;
        null !== $tags && $obj->tags = $tags;
        null !== $thumbnailURL && $obj->thumbnailURL = $thumbnailURL;
        null !== $url && $obj->url = $url;
        null !== $versionInfo && $obj->versionInfo = $versionInfo;
        null !== $videoCodec && $obj->videoCodec = $videoCodec;
        null !== $width && $obj->width = $width;

        return $obj;
    }

    /**
     * An array of tags assigned to the uploaded file by auto tagging.
     *
     * @param null|list<AITag> $aiTags
     */
    public function setAITags(?array $aiTags): self
    {
        $this->aiTags = $aiTags;

        return $this;
    }

    /**
     * The audio codec used in the video (only for video).
     */
    public function setAudioCodec(string $audioCodec): self
    {
        $this->audioCodec = $audioCodec;

        return $this;
    }

    /**
     * The bit rate of the video in kbps (only for video).
     */
    public function setBitRate(int $bitRate): self
    {
        $this->bitRate = $bitRate;

        return $this;
    }

    /**
     * Value of custom coordinates associated with the image in the format `x,y,width,height`. If `customCoordinates` are not defined, then it is `null`. Send `customCoordinates` in `responseFields` in API request to get the value of this field.
     */
    public function setCustomCoordinates(?string $customCoordinates): self
    {
        $this->customCoordinates = $customCoordinates;

        return $this;
    }

    /**
     * A key-value data associated with the asset. Use `responseField` in API request to get `customMetadata` in the upload API response. Before setting any custom metadata on an asset, you have to create the field using custom metadata fields API. Send `customMetadata` in `responseFields` in API request to get the value of this field.
     */
    public function setCustomMetadata(mixed $customMetadata): self
    {
        $this->customMetadata = $customMetadata;

        return $this;
    }

    /**
     * The duration of the video in seconds (only for video).
     */
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Consolidated embedded metadata associated with the file. It includes exif, iptc, and xmp data. Send `embeddedMetadata` in `responseFields` in API request to get embeddedMetadata in the upload API response.
     */
    public function setEmbeddedMetadata(
        EmbeddedMetadata $embeddedMetadata
    ): self {
        $this->embeddedMetadata = $embeddedMetadata;

        return $this;
    }

    /**
     * Extension names with their processing status at the time of completion of the request. It could have one of the following status values:
     *
     * `success`: The extension has been successfully applied.
     * `failed`: The extension has failed and will not be retried.
     * `pending`: The extension will finish processing in some time. On completion, the final status (success / failed) will be sent to the `webhookUrl` provided.
     *
     * If no extension was requested, then this parameter is not returned.
     */
    public function setExtensionStatus(ExtensionStatus $extensionStatus): self
    {
        $this->extensionStatus = $extensionStatus;

        return $this;
    }

    /**
     * Unique fileId. Store this fileld in your database, as this will be used to perform update action on this file.
     */
    public function setFileID(string $fileID): self
    {
        $this->fileID = $fileID;

        return $this;
    }

    /**
     * The relative path of the file in the media library e.g. `/marketing-assets/new-banner.jpg`.
     */
    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * Type of the uploaded file. Possible values are `image`, `non-image`.
     */
    public function setFileType(string $fileType): self
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * Height of the image in pixels (Only for images).
     */
    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Is the file marked as private. It can be either `true` or `false`. Send `isPrivateFile` in `responseFields` in API request to get the value of this field.
     */
    public function setIsPrivateFile(bool $isPrivateFile): self
    {
        $this->isPrivateFile = $isPrivateFile;

        return $this;
    }

    /**
     * Is the file published or in draft state. It can be either `true` or `false`. Send `isPublished` in `responseFields` in API request to get the value of this field.
     */
    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Legacy metadata. Send `metadata` in `responseFields` in API request to get metadata in the upload API response.
     */
    public function setMetadata(Metadata $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Name of the asset.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Size of the image file in Bytes.
     */
    public function setSize(float $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * The array of tags associated with the asset. If no tags are set, it will be `null`. Send `tags` in `responseFields` in API request to get the value of this field.
     *
     * @param null|list<string> $tags
     */
    public function setTags(?array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * In the case of an image, a small thumbnail URL.
     */
    public function setThumbnailURL(string $thumbnailURL): self
    {
        $this->thumbnailURL = $thumbnailURL;

        return $this;
    }

    /**
     * A publicly accessible URL of the file.
     */
    public function setURL(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * An object containing the file or file version's `id` (versionId) and `name`.
     */
    public function setVersionInfo(VersionInfo $versionInfo): self
    {
        $this->versionInfo = $versionInfo;

        return $this;
    }

    /**
     * The video codec used in the video (only for video).
     */
    public function setVideoCodec(string $videoCodec): self
    {
        $this->videoCodec = $videoCodec;

        return $this;
    }

    /**
     * Width of the image in pixels (Only for Images).
     */
    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }
}
