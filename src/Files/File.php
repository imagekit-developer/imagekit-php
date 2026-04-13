<?php

declare(strict_types=1);

namespace Imagekit\Files;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Files\File\AITag;
use Imagekit\Files\File\SelectedFieldsSchema;
use Imagekit\Files\File\Type;
use Imagekit\Files\File\VersionInfo;

/**
 * Object containing details of a file or file version.
 *
 * @phpstan-import-type AITagShape from \Imagekit\Files\File\AITag
 * @phpstan-import-type SelectedFieldsSchemaShape from \Imagekit\Files\File\SelectedFieldsSchema
 * @phpstan-import-type VersionInfoShape from \Imagekit\Files\File\VersionInfo
 *
 * @phpstan-type FileShape = array{
 *   aiTags?: list<AITag|AITagShape>|null,
 *   audioCodec?: string|null,
 *   bitRate?: int|null,
 *   createdAt?: \DateTimeInterface|null,
 *   customCoordinates?: string|null,
 *   customMetadata?: array<string,mixed>|null,
 *   description?: string|null,
 *   duration?: int|null,
 *   embeddedMetadata?: array<string,mixed>|null,
 *   fileID?: string|null,
 *   filePath?: string|null,
 *   fileType?: string|null,
 *   hasAlpha?: bool|null,
 *   height?: float|null,
 *   isPrivateFile?: bool|null,
 *   isPublished?: bool|null,
 *   mime?: string|null,
 *   name?: string|null,
 *   selectedFieldsSchema?: array<string,SelectedFieldsSchema|SelectedFieldsSchemaShape>|null,
 *   size?: float|null,
 *   tags?: list<string>|null,
 *   thumbnail?: string|null,
 *   type?: null|Type|value-of<Type>,
 *   updatedAt?: \DateTimeInterface|null,
 *   url?: string|null,
 *   versionInfo?: null|VersionInfo|VersionInfoShape,
 *   videoCodec?: string|null,
 *   width?: float|null,
 * }
 */
final class File implements BaseModel
{
    /** @use SdkModel<FileShape> */
    use SdkModel;

    /**
     * Array of AI-generated tags associated with the image. If no AITags are set, it will be null.
     *
     * @var list<AITag>|null $aiTags
     */
    #[Optional('AITags', list: AITag::class, nullable: true)]
    public ?array $aiTags;

    /**
     * The audio codec used in the video (only for video/audio).
     */
    #[Optional]
    public ?string $audioCodec;

    /**
     * The bit rate of the video in kbps (only for video).
     */
    #[Optional]
    public ?int $bitRate;

    /**
     * Date and time when the file was uploaded. The date and time is in ISO8601 format.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * An string with custom coordinates of the file.
     */
    #[Optional(nullable: true)]
    public ?string $customCoordinates;

    /**
     * An object with custom metadata for the file.
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
     * Consolidated embedded metadata associated with the file. It includes exif, iptc, and xmp data.
     *
     * @var array<string,mixed>|null $embeddedMetadata
     */
    #[Optional(map: 'mixed')]
    public ?array $embeddedMetadata;

    /**
     * Unique identifier of the asset.
     */
    #[Optional('fileId')]
    public ?string $fileID;

    /**
     * Path of the file. This is the path you would use in the URL to access the file. For example, if the file is at the root of the media library, the path will be `/file.jpg`. If the file is inside a folder named `images`, the path will be `/images/file.jpg`.
     */
    #[Optional]
    public ?string $filePath;

    /**
     * Type of the file. Possible values are `image`, `non-image`.
     */
    #[Optional]
    public ?string $fileType;

    /**
     * Specifies if the image has an alpha channel.
     */
    #[Optional]
    public ?bool $hasAlpha;

    /**
     * Height of the file.
     */
    #[Optional]
    public ?float $height;

    /**
     * Specifies if the file is private or not.
     */
    #[Optional]
    public ?bool $isPrivateFile;

    /**
     * Specifies if the file is published or not.
     */
    #[Optional]
    public ?bool $isPublished;

    /**
     * MIME type of the file.
     */
    #[Optional]
    public ?string $mime;

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
     * Size of the file in bytes.
     */
    #[Optional]
    public ?float $size;

    /**
     * An array of tags assigned to the file. Tags are used to search files in the media library.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $tags;

    /**
     * URL of the thumbnail image. This URL is used to access the thumbnail image of the file in the media library.
     */
    #[Optional]
    public ?string $thumbnail;

    /**
     * Type of the asset.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * Date and time when the file was last updated. The date and time is in ISO8601 format.
     */
    #[Optional]
    public ?\DateTimeInterface $updatedAt;

    /**
     * URL of the file.
     */
    #[Optional]
    public ?string $url;

    /**
     * An object with details of the file version.
     */
    #[Optional]
    public ?VersionInfo $versionInfo;

    /**
     * The video codec used in the video (only for video).
     */
    #[Optional]
    public ?string $videoCodec;

    /**
     * Width of the file.
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
     * @param list<AITag|AITagShape>|null $aiTags
     * @param array<string,mixed>|null $customMetadata
     * @param array<string,mixed>|null $embeddedMetadata
     * @param array<string,SelectedFieldsSchema|SelectedFieldsSchemaShape>|null $selectedFieldsSchema
     * @param list<string>|null $tags
     * @param Type|value-of<Type>|null $type
     * @param VersionInfo|VersionInfoShape|null $versionInfo
     */
    public static function with(
        ?array $aiTags = null,
        ?string $audioCodec = null,
        ?int $bitRate = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?string $description = null,
        ?int $duration = null,
        ?array $embeddedMetadata = null,
        ?string $fileID = null,
        ?string $filePath = null,
        ?string $fileType = null,
        ?bool $hasAlpha = null,
        ?float $height = null,
        ?bool $isPrivateFile = null,
        ?bool $isPublished = null,
        ?string $mime = null,
        ?string $name = null,
        ?array $selectedFieldsSchema = null,
        ?float $size = null,
        ?array $tags = null,
        ?string $thumbnail = null,
        Type|string|null $type = null,
        ?\DateTimeInterface $updatedAt = null,
        ?string $url = null,
        VersionInfo|array|null $versionInfo = null,
        ?string $videoCodec = null,
        ?float $width = null,
    ): self {
        $self = new self;

        null !== $aiTags && $self['aiTags'] = $aiTags;
        null !== $audioCodec && $self['audioCodec'] = $audioCodec;
        null !== $bitRate && $self['bitRate'] = $bitRate;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $customCoordinates && $self['customCoordinates'] = $customCoordinates;
        null !== $customMetadata && $self['customMetadata'] = $customMetadata;
        null !== $description && $self['description'] = $description;
        null !== $duration && $self['duration'] = $duration;
        null !== $embeddedMetadata && $self['embeddedMetadata'] = $embeddedMetadata;
        null !== $fileID && $self['fileID'] = $fileID;
        null !== $filePath && $self['filePath'] = $filePath;
        null !== $fileType && $self['fileType'] = $fileType;
        null !== $hasAlpha && $self['hasAlpha'] = $hasAlpha;
        null !== $height && $self['height'] = $height;
        null !== $isPrivateFile && $self['isPrivateFile'] = $isPrivateFile;
        null !== $isPublished && $self['isPublished'] = $isPublished;
        null !== $mime && $self['mime'] = $mime;
        null !== $name && $self['name'] = $name;
        null !== $selectedFieldsSchema && $self['selectedFieldsSchema'] = $selectedFieldsSchema;
        null !== $size && $self['size'] = $size;
        null !== $tags && $self['tags'] = $tags;
        null !== $thumbnail && $self['thumbnail'] = $thumbnail;
        null !== $type && $self['type'] = $type;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;
        null !== $url && $self['url'] = $url;
        null !== $versionInfo && $self['versionInfo'] = $versionInfo;
        null !== $videoCodec && $self['videoCodec'] = $videoCodec;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Array of AI-generated tags associated with the image. If no AITags are set, it will be null.
     *
     * @param list<AITag|AITagShape>|null $aiTags
     */
    public function withAITags(?array $aiTags): self
    {
        $self = clone $this;
        $self['aiTags'] = $aiTags;

        return $self;
    }

    /**
     * The audio codec used in the video (only for video/audio).
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
     * Date and time when the file was uploaded. The date and time is in ISO8601 format.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * An string with custom coordinates of the file.
     */
    public function withCustomCoordinates(?string $customCoordinates): self
    {
        $self = clone $this;
        $self['customCoordinates'] = $customCoordinates;

        return $self;
    }

    /**
     * An object with custom metadata for the file.
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
     * Consolidated embedded metadata associated with the file. It includes exif, iptc, and xmp data.
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
     * Unique identifier of the asset.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * Path of the file. This is the path you would use in the URL to access the file. For example, if the file is at the root of the media library, the path will be `/file.jpg`. If the file is inside a folder named `images`, the path will be `/images/file.jpg`.
     */
    public function withFilePath(string $filePath): self
    {
        $self = clone $this;
        $self['filePath'] = $filePath;

        return $self;
    }

    /**
     * Type of the file. Possible values are `image`, `non-image`.
     */
    public function withFileType(string $fileType): self
    {
        $self = clone $this;
        $self['fileType'] = $fileType;

        return $self;
    }

    /**
     * Specifies if the image has an alpha channel.
     */
    public function withHasAlpha(bool $hasAlpha): self
    {
        $self = clone $this;
        $self['hasAlpha'] = $hasAlpha;

        return $self;
    }

    /**
     * Height of the file.
     */
    public function withHeight(float $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Specifies if the file is private or not.
     */
    public function withIsPrivateFile(bool $isPrivateFile): self
    {
        $self = clone $this;
        $self['isPrivateFile'] = $isPrivateFile;

        return $self;
    }

    /**
     * Specifies if the file is published or not.
     */
    public function withIsPublished(bool $isPublished): self
    {
        $self = clone $this;
        $self['isPublished'] = $isPublished;

        return $self;
    }

    /**
     * MIME type of the file.
     */
    public function withMime(string $mime): self
    {
        $self = clone $this;
        $self['mime'] = $mime;

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
     * @param array<string,SelectedFieldsSchema|SelectedFieldsSchemaShape> $selectedFieldsSchema
     */
    public function withSelectedFieldsSchema(array $selectedFieldsSchema): self
    {
        $self = clone $this;
        $self['selectedFieldsSchema'] = $selectedFieldsSchema;

        return $self;
    }

    /**
     * Size of the file in bytes.
     */
    public function withSize(float $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * An array of tags assigned to the file. Tags are used to search files in the media library.
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
     * URL of the thumbnail image. This URL is used to access the thumbnail image of the file in the media library.
     */
    public function withThumbnail(string $thumbnail): self
    {
        $self = clone $this;
        $self['thumbnail'] = $thumbnail;

        return $self;
    }

    /**
     * Type of the asset.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Date and time when the file was last updated. The date and time is in ISO8601 format.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * URL of the file.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * An object with details of the file version.
     *
     * @param VersionInfo|VersionInfoShape $versionInfo
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
     * Width of the file.
     */
    public function withWidth(float $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
