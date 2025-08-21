<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Core\Conversion\MapOf;
use ImageKit\Responses\Files\FileUpdateResponse\AITag;
use ImageKit\Responses\Files\FileUpdateResponse\ExtensionStatus;
use ImageKit\Responses\Files\FileUpdateResponse\VersionInfo;

/**
 * @phpstan-type file_update_response_alias = array{
 *   aiTags?: list<AITag>|null,
 *   createdAt?: string,
 *   customCoordinates?: string|null,
 *   customMetadata?: array<string, mixed>,
 *   extensionStatus?: ExtensionStatus,
 *   fileID?: string,
 *   filePath?: string,
 *   fileType?: string,
 *   hasAlpha?: bool,
 *   height?: float,
 *   isPrivateFile?: bool,
 *   isPublished?: bool,
 *   mime?: string,
 *   name?: string,
 *   size?: float,
 *   tags?: list<string>|null,
 *   thumbnail?: string,
 *   type?: string,
 *   updatedAt?: string,
 *   url?: string,
 *   versionInfo?: VersionInfo,
 *   width?: float,
 * }
 */
final class FileUpdateResponse implements BaseModel
{
    use SdkModel;

    /**
     * An array of tags assigned to the file by auto tagging.
     *
     * @var list<AITag>|null $aiTags
     */
    #[Api(
        'AITags',
        type: new ListOf(AITag::class),
        nullable: true,
        optional: true
    )]
    public ?array $aiTags;

    /**
     * Date and time when the file was uploaded. The date and time is in ISO8601 format.
     */
    #[Api(optional: true)]
    public ?string $createdAt;

    /**
     * An string with custom coordinates of the file.
     */
    #[Api(optional: true)]
    public ?string $customCoordinates;

    /**
     * An object with custom metadata for the file.
     *
     * @var array<string, mixed>|null $customMetadata
     */
    #[Api(type: new MapOf('string'), optional: true)]
    public ?array $customMetadata;

    #[Api(optional: true)]
    public ?ExtensionStatus $extensionStatus;

    /**
     * Unique identifier of the asset.
     */
    #[Api('fileId', optional: true)]
    public ?string $fileID;

    /**
     * Path of the file. This is the path you would use in the URL to access the file. For example, if the file is at the root of the media library, the path will be `/file.jpg`. If the file is inside a folder named `images`, the path will be `/images/file.jpg`.
     */
    #[Api(optional: true)]
    public ?string $filePath;

    /**
     * Type of the file. Possible values are `image`, `non-image`.
     */
    #[Api(optional: true)]
    public ?string $fileType;

    /**
     * Specifies if the image has an alpha channel.
     */
    #[Api(optional: true)]
    public ?bool $hasAlpha;

    /**
     * Height of the file.
     */
    #[Api(optional: true)]
    public ?float $height;

    /**
     * Specifies if the file is private or not.
     */
    #[Api(optional: true)]
    public ?bool $isPrivateFile;

    /**
     * Specifies if the file is published or not.
     */
    #[Api(optional: true)]
    public ?bool $isPublished;

    /**
     * MIME type of the file.
     */
    #[Api(optional: true)]
    public ?string $mime;

    /**
     * Name of the asset.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * Size of the file in bytes.
     */
    #[Api(optional: true)]
    public ?float $size;

    /**
     * An array of tags assigned to the file. Tags are used to search files in the media library.
     *
     * @var list<string>|null $tags
     */
    #[Api(type: new ListOf('string'), nullable: true, optional: true)]
    public ?array $tags;

    /**
     * URL of the thumbnail image. This URL is used to access the thumbnail image of the file in the media library.
     */
    #[Api(optional: true)]
    public ?string $thumbnail;

    /**
     * Type of the asset.
     */
    #[Api(optional: true)]
    public ?string $type;

    /**
     * Date and time when the file was last updated. The date and time is in ISO8601 format.
     */
    #[Api(optional: true)]
    public ?string $updatedAt;

    /**
     * URL of the file.
     */
    #[Api(optional: true)]
    public ?string $url;

    /**
     * An object with details of the file version.
     */
    #[Api(optional: true)]
    public ?VersionInfo $versionInfo;

    /**
     * Width of the file.
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
     * @param list<AITag>|null $aiTags
     * @param array<string, mixed>|null $customMetadata
     * @param list<string>|null $tags
     */
    public static function with(
        ?array $aiTags = null,
        ?string $createdAt = null,
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?ExtensionStatus $extensionStatus = null,
        ?string $fileID = null,
        ?string $filePath = null,
        ?string $fileType = null,
        ?bool $hasAlpha = null,
        ?float $height = null,
        ?bool $isPrivateFile = null,
        ?bool $isPublished = null,
        ?string $mime = null,
        ?string $name = null,
        ?float $size = null,
        ?array $tags = null,
        ?string $thumbnail = null,
        ?string $type = null,
        ?string $updatedAt = null,
        ?string $url = null,
        ?VersionInfo $versionInfo = null,
        ?float $width = null,
    ): self {
        $obj = new self;

        null !== $aiTags && $obj->aiTags = $aiTags;
        null !== $createdAt && $obj->createdAt = $createdAt;
        null !== $customCoordinates && $obj->customCoordinates = $customCoordinates;
        null !== $customMetadata && $obj->customMetadata = $customMetadata;
        null !== $extensionStatus && $obj->extensionStatus = $extensionStatus;
        null !== $fileID && $obj->fileID = $fileID;
        null !== $filePath && $obj->filePath = $filePath;
        null !== $fileType && $obj->fileType = $fileType;
        null !== $hasAlpha && $obj->hasAlpha = $hasAlpha;
        null !== $height && $obj->height = $height;
        null !== $isPrivateFile && $obj->isPrivateFile = $isPrivateFile;
        null !== $isPublished && $obj->isPublished = $isPublished;
        null !== $mime && $obj->mime = $mime;
        null !== $name && $obj->name = $name;
        null !== $size && $obj->size = $size;
        null !== $tags && $obj->tags = $tags;
        null !== $thumbnail && $obj->thumbnail = $thumbnail;
        null !== $type && $obj->type = $type;
        null !== $updatedAt && $obj->updatedAt = $updatedAt;
        null !== $url && $obj->url = $url;
        null !== $versionInfo && $obj->versionInfo = $versionInfo;
        null !== $width && $obj->width = $width;

        return $obj;
    }

    /**
     * An array of tags assigned to the file by auto tagging.
     *
     * @param list<AITag>|null $aiTags
     */
    public function withAITags(?array $aiTags): self
    {
        $obj = clone $this;
        $obj->aiTags = $aiTags;

        return $obj;
    }

    /**
     * Date and time when the file was uploaded. The date and time is in ISO8601 format.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * An string with custom coordinates of the file.
     */
    public function withCustomCoordinates(?string $customCoordinates): self
    {
        $obj = clone $this;
        $obj->customCoordinates = $customCoordinates;

        return $obj;
    }

    /**
     * An object with custom metadata for the file.
     *
     * @param array<string, mixed> $customMetadata
     */
    public function withCustomMetadata(array $customMetadata): self
    {
        $obj = clone $this;
        $obj->customMetadata = $customMetadata;

        return $obj;
    }

    public function withExtensionStatus(ExtensionStatus $extensionStatus): self
    {
        $obj = clone $this;
        $obj->extensionStatus = $extensionStatus;

        return $obj;
    }

    /**
     * Unique identifier of the asset.
     */
    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj->fileID = $fileID;

        return $obj;
    }

    /**
     * Path of the file. This is the path you would use in the URL to access the file. For example, if the file is at the root of the media library, the path will be `/file.jpg`. If the file is inside a folder named `images`, the path will be `/images/file.jpg`.
     */
    public function withFilePath(string $filePath): self
    {
        $obj = clone $this;
        $obj->filePath = $filePath;

        return $obj;
    }

    /**
     * Type of the file. Possible values are `image`, `non-image`.
     */
    public function withFileType(string $fileType): self
    {
        $obj = clone $this;
        $obj->fileType = $fileType;

        return $obj;
    }

    /**
     * Specifies if the image has an alpha channel.
     */
    public function withHasAlpha(bool $hasAlpha): self
    {
        $obj = clone $this;
        $obj->hasAlpha = $hasAlpha;

        return $obj;
    }

    /**
     * Height of the file.
     */
    public function withHeight(float $height): self
    {
        $obj = clone $this;
        $obj->height = $height;

        return $obj;
    }

    /**
     * Specifies if the file is private or not.
     */
    public function withIsPrivateFile(bool $isPrivateFile): self
    {
        $obj = clone $this;
        $obj->isPrivateFile = $isPrivateFile;

        return $obj;
    }

    /**
     * Specifies if the file is published or not.
     */
    public function withIsPublished(bool $isPublished): self
    {
        $obj = clone $this;
        $obj->isPublished = $isPublished;

        return $obj;
    }

    /**
     * MIME type of the file.
     */
    public function withMime(string $mime): self
    {
        $obj = clone $this;
        $obj->mime = $mime;

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
     * Size of the file in bytes.
     */
    public function withSize(float $size): self
    {
        $obj = clone $this;
        $obj->size = $size;

        return $obj;
    }

    /**
     * An array of tags assigned to the file. Tags are used to search files in the media library.
     *
     * @param list<string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $obj = clone $this;
        $obj->tags = $tags;

        return $obj;
    }

    /**
     * URL of the thumbnail image. This URL is used to access the thumbnail image of the file in the media library.
     */
    public function withThumbnail(string $thumbnail): self
    {
        $obj = clone $this;
        $obj->thumbnail = $thumbnail;

        return $obj;
    }

    /**
     * Type of the asset.
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * Date and time when the file was last updated. The date and time is in ISO8601 format.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }

    /**
     * URL of the file.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    /**
     * An object with details of the file version.
     */
    public function withVersionInfo(VersionInfo $versionInfo): self
    {
        $obj = clone $this;
        $obj->versionInfo = $versionInfo;

        return $obj;
    }

    /**
     * Width of the file.
     */
    public function withWidth(float $width): self
    {
        $obj = clone $this;
        $obj->width = $width;

        return $obj;
    }
}
