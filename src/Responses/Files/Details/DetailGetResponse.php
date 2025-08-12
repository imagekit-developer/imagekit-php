<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Details;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Responses\Files\Details\DetailGetResponse\AITag;
use ImageKit\Responses\Files\Details\DetailGetResponse\VersionInfo;

/**
 * Object containing details of a file or file version.
 *
 * @phpstan-type detail_get_response_alias = array{
 *   aiTags?: list<AITag>|null,
 *   createdAt?: string,
 *   customCoordinates?: string|null,
 *   customMetadata?: mixed,
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
final class DetailGetResponse implements BaseModel
{
    use Model;

    /**
     * An array of tags assigned to the file by auto tagging.
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
     */
    #[Api(optional: true)]
    public mixed $customMetadata;

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
     * @var null|list<string> $tags
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
     * @param null|list<AITag> $aiTags
     * @param null|list<string> $tags
     */
    public static function from(
        ?array $aiTags = null,
        ?string $createdAt = null,
        ?string $customCoordinates = null,
        mixed $customMetadata = null,
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
     * @param null|list<AITag> $aiTags
     */
    public function setAITags(?array $aiTags): self
    {
        $this->aiTags = $aiTags;

        return $this;
    }

    /**
     * Date and time when the file was uploaded. The date and time is in ISO8601 format.
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * An string with custom coordinates of the file.
     */
    public function setCustomCoordinates(?string $customCoordinates): self
    {
        $this->customCoordinates = $customCoordinates;

        return $this;
    }

    /**
     * An object with custom metadata for the file.
     */
    public function setCustomMetadata(mixed $customMetadata): self
    {
        $this->customMetadata = $customMetadata;

        return $this;
    }

    /**
     * Unique identifier of the asset.
     */
    public function setFileID(string $fileID): self
    {
        $this->fileID = $fileID;

        return $this;
    }

    /**
     * Path of the file. This is the path you would use in the URL to access the file. For example, if the file is at the root of the media library, the path will be `/file.jpg`. If the file is inside a folder named `images`, the path will be `/images/file.jpg`.
     */
    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * Type of the file. Possible values are `image`, `non-image`.
     */
    public function setFileType(string $fileType): self
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * Specifies if the image has an alpha channel.
     */
    public function setHasAlpha(bool $hasAlpha): self
    {
        $this->hasAlpha = $hasAlpha;

        return $this;
    }

    /**
     * Height of the file.
     */
    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Specifies if the file is private or not.
     */
    public function setIsPrivateFile(bool $isPrivateFile): self
    {
        $this->isPrivateFile = $isPrivateFile;

        return $this;
    }

    /**
     * Specifies if the file is published or not.
     */
    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * MIME type of the file.
     */
    public function setMime(string $mime): self
    {
        $this->mime = $mime;

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
     * Size of the file in bytes.
     */
    public function setSize(float $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * An array of tags assigned to the file. Tags are used to search files in the media library.
     *
     * @param null|list<string> $tags
     */
    public function setTags(?array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * URL of the thumbnail image. This URL is used to access the thumbnail image of the file in the media library.
     */
    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Type of the asset.
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Date and time when the file was last updated. The date and time is in ISO8601 format.
     */
    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * URL of the file.
     */
    public function setURL(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * An object with details of the file version.
     */
    public function setVersionInfo(VersionInfo $versionInfo): self
    {
        $this->versionInfo = $versionInfo;

        return $this;
    }

    /**
     * Width of the file.
     */
    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }
}
