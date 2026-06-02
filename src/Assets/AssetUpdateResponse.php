<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Assets\AssetUpdateResponse\ExtensionStatus;
use ImageKit\Assets\FileAsset\AITag;
use ImageKit\Assets\FileAsset\VersionInfo;
use ImageKit\Assets\FileDetails\Type;
use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing details of a file.
 *
 * @phpstan-import-type AITagShape from \ImageKit\Assets\FileAsset\AITag
 * @phpstan-import-type MetadataShape from \ImageKit\Assets\Metadata
 * @phpstan-import-type VersionInfoShape from \ImageKit\Assets\FileAsset\VersionInfo
 * @phpstan-import-type ExtensionStatusShape from \ImageKit\Assets\AssetUpdateResponse\ExtensionStatus
 *
 * @phpstan-type AssetUpdateResponseShape = array{
 *   id?: string|null,
 *   aiTags?: list<AITag|AITagShape>|null,
 *   assetType?: string|null,
 *   assetURL?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   customCoordinates?: string|null,
 *   customMetadata?: array<string,mixed>|null,
 *   description?: string|null,
 *   embeddedMetadata?: array<string,mixed>|null,
 *   isPrivateFile?: bool|null,
 *   isPublished?: bool|null,
 *   metadata?: null|Metadata|MetadataShape,
 *   name?: string|null,
 *   path?: string|null,
 *   size?: float|null,
 *   tags?: list<string>|null,
 *   thumbnailURL?: string|null,
 *   updatedAt?: \DateTimeInterface|null,
 *   versionInfo?: null|VersionInfo|VersionInfoShape,
 *   type?: null|Type|value-of<Type>,
 *   extensionStatus?: null|ExtensionStatus|ExtensionStatusShape,
 * }
 */
final class AssetUpdateResponse implements BaseModel
{
    /** @use SdkModel<AssetUpdateResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the asset.
     */
    #[Optional]
    public ?string $id;

    /** @var list<AITag>|null $aiTags */
    #[Optional('ai_tags', list: AITag::class)]
    public ?array $aiTags;

    /**
     * Type of the uploaded asset. Possible values are `image`, `video`, `audio` or `static`.
     */
    #[Optional('asset_type')]
    public ?string $assetType;

    /**
     * A publicly accessible URL of the asset.
     */
    #[Optional('asset_url')]
    public ?string $assetURL;

    /**
     * Date and time when the file was uploaded. The date and time is in ISO8601 format.
     */
    #[Optional('created_at')]
    public ?\DateTimeInterface $createdAt;

    /**
     * A string with custom coordinates of the file in the format `x,y,width,height`. If `custom_coordinates` are not defined, then it is `null`.
     */
    #[Optional('custom_coordinates', nullable: true)]
    public ?string $customCoordinates;

    /**
     * A key-value data associated with the asset.
     *
     * @var array<string,mixed>|null $customMetadata
     */
    #[Optional('custom_metadata', map: 'mixed')]
    public ?array $customMetadata;

    /**
     * Optional text to describe the contents of the file. Can be set by the user or the ai-auto-description extension.
     */
    #[Optional]
    public ?string $description;

    /**
     * Consolidated embedded metadata associated with the file. It includes exif, iptc, and xmp data.
     *
     * @var array<string,mixed>|null $embeddedMetadata
     */
    #[Optional('embedded_metadata', map: 'mixed')]
    public ?array $embeddedMetadata;

    /**
     * Specifies if the file is private or not.
     */
    #[Optional('is_private_file')]
    public ?bool $isPrivateFile;

    /**
     * Specifies if the file is published or not.
     */
    #[Optional('is_published')]
    public ?bool $isPublished;

    /**
     * JSON object containing metadata.
     */
    #[Optional]
    public ?Metadata $metadata;

    /**
     * Name of the asset.
     */
    #[Optional]
    public ?string $name;

    /**
     * Path of the file. This is the path you would use in the URL to access the file. For example, if the file is at the root of the media library, the path will be `/file.jpg`. If the file is inside a folder named `images`, the path will be `/images/file.jpg`.
     */
    #[Optional]
    public ?string $path;

    /**
     * Size of the file in bytes.
     */
    #[Optional]
    public ?float $size;

    /**
     * The array of tags associated with the asset. If no tags are set, it will be `null`. Send `tags` in `responseFields` in API request to get the value of this field.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * In the case of an image, a small thumbnail URL.
     */
    #[Optional('thumbnail_url')]
    public ?string $thumbnailURL;

    /**
     * Date and time when the file was last updated. The date and time is in ISO8601 format.
     */
    #[Optional('updated_at')]
    public ?\DateTimeInterface $updatedAt;

    /**
     * An object containing the file or file version's `id` (versionId) and `name`.
     */
    #[Optional('version_info')]
    public ?VersionInfo $versionInfo;

    /**
     * Type of the asset.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * Status of each extension that was applied. Only present when extensions were requested.
     */
    #[Optional('extension_status')]
    public ?ExtensionStatus $extensionStatus;

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
     * @param Metadata|MetadataShape|null $metadata
     * @param list<string>|null $tags
     * @param VersionInfo|VersionInfoShape|null $versionInfo
     * @param Type|value-of<Type>|null $type
     * @param ExtensionStatus|ExtensionStatusShape|null $extensionStatus
     */
    public static function with(
        ?string $id = null,
        ?array $aiTags = null,
        ?string $assetType = null,
        ?string $assetURL = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?string $description = null,
        ?array $embeddedMetadata = null,
        ?bool $isPrivateFile = null,
        ?bool $isPublished = null,
        Metadata|array|null $metadata = null,
        ?string $name = null,
        ?string $path = null,
        ?float $size = null,
        ?array $tags = null,
        ?string $thumbnailURL = null,
        ?\DateTimeInterface $updatedAt = null,
        VersionInfo|array|null $versionInfo = null,
        Type|string|null $type = null,
        ExtensionStatus|array|null $extensionStatus = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $aiTags && $self['aiTags'] = $aiTags;
        null !== $assetType && $self['assetType'] = $assetType;
        null !== $assetURL && $self['assetURL'] = $assetURL;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $customCoordinates && $self['customCoordinates'] = $customCoordinates;
        null !== $customMetadata && $self['customMetadata'] = $customMetadata;
        null !== $description && $self['description'] = $description;
        null !== $embeddedMetadata && $self['embeddedMetadata'] = $embeddedMetadata;
        null !== $isPrivateFile && $self['isPrivateFile'] = $isPrivateFile;
        null !== $isPublished && $self['isPublished'] = $isPublished;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;
        null !== $path && $self['path'] = $path;
        null !== $size && $self['size'] = $size;
        null !== $tags && $self['tags'] = $tags;
        null !== $thumbnailURL && $self['thumbnailURL'] = $thumbnailURL;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;
        null !== $versionInfo && $self['versionInfo'] = $versionInfo;
        null !== $type && $self['type'] = $type;
        null !== $extensionStatus && $self['extensionStatus'] = $extensionStatus;

        return $self;
    }

    /**
     * Unique identifier of the asset.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param list<AITag|AITagShape> $aiTags
     */
    public function withAITags(array $aiTags): self
    {
        $self = clone $this;
        $self['aiTags'] = $aiTags;

        return $self;
    }

    /**
     * Type of the uploaded asset. Possible values are `image`, `video`, `audio` or `static`.
     */
    public function withAssetType(string $assetType): self
    {
        $self = clone $this;
        $self['assetType'] = $assetType;

        return $self;
    }

    /**
     * A publicly accessible URL of the asset.
     */
    public function withAssetURL(string $assetURL): self
    {
        $self = clone $this;
        $self['assetURL'] = $assetURL;

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
     * A string with custom coordinates of the file in the format `x,y,width,height`. If `custom_coordinates` are not defined, then it is `null`.
     */
    public function withCustomCoordinates(?string $customCoordinates): self
    {
        $self = clone $this;
        $self['customCoordinates'] = $customCoordinates;

        return $self;
    }

    /**
     * A key-value data associated with the asset.
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
     * JSON object containing metadata.
     *
     * @param Metadata|MetadataShape $metadata
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
     * Path of the file. This is the path you would use in the URL to access the file. For example, if the file is at the root of the media library, the path will be `/file.jpg`. If the file is inside a folder named `images`, the path will be `/images/file.jpg`.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

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
     * The array of tags associated with the asset. If no tags are set, it will be `null`. Send `tags` in `responseFields` in API request to get the value of this field.
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
     * In the case of an image, a small thumbnail URL.
     */
    public function withThumbnailURL(string $thumbnailURL): self
    {
        $self = clone $this;
        $self['thumbnailURL'] = $thumbnailURL;

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
     * An object containing the file or file version's `id` (versionId) and `name`.
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
     * Status of each extension that was applied. Only present when extensions were requested.
     *
     * @param ExtensionStatus|ExtensionStatusShape $extensionStatus
     */
    public function withExtensionStatus(
        ExtensionStatus|array $extensionStatus
    ): self {
        $self = clone $this;
        $self['extensionStatus'] = $extensionStatus;

        return $self;
    }
}
