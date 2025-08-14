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
    public static function with(
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
    public function withAITags(?array $aiTags): self
    {
        $obj = clone $this;
        $obj->aiTags = $aiTags;

        return $obj;
    }

    /**
     * The audio codec used in the video (only for video).
     */
    public function withAudioCodec(string $audioCodec): self
    {
        $obj = clone $this;
        $obj->audioCodec = $audioCodec;

        return $obj;
    }

    /**
     * The bit rate of the video in kbps (only for video).
     */
    public function withBitRate(int $bitRate): self
    {
        $obj = clone $this;
        $obj->bitRate = $bitRate;

        return $obj;
    }

    /**
     * Value of custom coordinates associated with the image in the format `x,y,width,height`. If `customCoordinates` are not defined, then it is `null`. Send `customCoordinates` in `responseFields` in API request to get the value of this field.
     */
    public function withCustomCoordinates(?string $customCoordinates): self
    {
        $obj = clone $this;
        $obj->customCoordinates = $customCoordinates;

        return $obj;
    }

    /**
     * A key-value data associated with the asset. Use `responseField` in API request to get `customMetadata` in the upload API response. Before setting any custom metadata on an asset, you have to create the field using custom metadata fields API. Send `customMetadata` in `responseFields` in API request to get the value of this field.
     */
    public function withCustomMetadata(mixed $customMetadata): self
    {
        $obj = clone $this;
        $obj->customMetadata = $customMetadata;

        return $obj;
    }

    /**
     * The duration of the video in seconds (only for video).
     */
    public function withDuration(int $duration): self
    {
        $obj = clone $this;
        $obj->duration = $duration;

        return $obj;
    }

    /**
     * Consolidated embedded metadata associated with the file. It includes exif, iptc, and xmp data. Send `embeddedMetadata` in `responseFields` in API request to get embeddedMetadata in the upload API response.
     */
    public function withEmbeddedMetadata(
        EmbeddedMetadata $embeddedMetadata
    ): self {
        $obj = clone $this;
        $obj->embeddedMetadata = $embeddedMetadata;

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
     */
    public function withExtensionStatus(ExtensionStatus $extensionStatus): self
    {
        $obj = clone $this;
        $obj->extensionStatus = $extensionStatus;

        return $obj;
    }

    /**
     * Unique fileId. Store this fileld in your database, as this will be used to perform update action on this file.
     */
    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj->fileID = $fileID;

        return $obj;
    }

    /**
     * The relative path of the file in the media library e.g. `/marketing-assets/new-banner.jpg`.
     */
    public function withFilePath(string $filePath): self
    {
        $obj = clone $this;
        $obj->filePath = $filePath;

        return $obj;
    }

    /**
     * Type of the uploaded file. Possible values are `image`, `non-image`.
     */
    public function withFileType(string $fileType): self
    {
        $obj = clone $this;
        $obj->fileType = $fileType;

        return $obj;
    }

    /**
     * Height of the image in pixels (Only for images).
     */
    public function withHeight(float $height): self
    {
        $obj = clone $this;
        $obj->height = $height;

        return $obj;
    }

    /**
     * Is the file marked as private. It can be either `true` or `false`. Send `isPrivateFile` in `responseFields` in API request to get the value of this field.
     */
    public function withIsPrivateFile(bool $isPrivateFile): self
    {
        $obj = clone $this;
        $obj->isPrivateFile = $isPrivateFile;

        return $obj;
    }

    /**
     * Is the file published or in draft state. It can be either `true` or `false`. Send `isPublished` in `responseFields` in API request to get the value of this field.
     */
    public function withIsPublished(bool $isPublished): self
    {
        $obj = clone $this;
        $obj->isPublished = $isPublished;

        return $obj;
    }

    /**
     * Legacy metadata. Send `metadata` in `responseFields` in API request to get metadata in the upload API response.
     */
    public function withMetadata(Metadata $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Name of the asset.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Size of the image file in Bytes.
     */
    public function withSize(float $size): self
    {
        $obj = clone $this;
        $obj->size = $size;

        return $obj;
    }

    /**
     * The array of tags associated with the asset. If no tags are set, it will be `null`. Send `tags` in `responseFields` in API request to get the value of this field.
     *
     * @param null|list<string> $tags
     */
    public function withTags(?array $tags): self
    {
        $obj = clone $this;
        $obj->tags = $tags;

        return $obj;
    }

    /**
     * In the case of an image, a small thumbnail URL.
     */
    public function withThumbnailURL(string $thumbnailURL): self
    {
        $obj = clone $this;
        $obj->thumbnailURL = $thumbnailURL;

        return $obj;
    }

    /**
     * A publicly accessible URL of the file.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    /**
     * An object containing the file or file version's `id` (versionId) and `name`.
     */
    public function withVersionInfo(VersionInfo $versionInfo): self
    {
        $obj = clone $this;
        $obj->versionInfo = $versionInfo;

        return $obj;
    }

    /**
     * The video codec used in the video (only for video).
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $obj = clone $this;
        $obj->videoCodec = $videoCodec;

        return $obj;
    }

    /**
     * Width of the image in pixels (Only for Images).
     */
    public function withWidth(float $width): self
    {
        $obj = clone $this;
        $obj->width = $width;

        return $obj;
    }
}
