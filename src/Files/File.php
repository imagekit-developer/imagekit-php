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
 * @phpstan-type FileShape = array{
 *   aiTags?: list<AITag>|null,
 *   createdAt?: \DateTimeInterface|null,
 *   customCoordinates?: string|null,
 *   customMetadata?: array<string,mixed>|null,
 *   description?: string|null,
 *   fileID?: string|null,
 *   filePath?: string|null,
 *   fileType?: string|null,
 *   hasAlpha?: bool|null,
 *   height?: float|null,
 *   isPrivateFile?: bool|null,
 *   isPublished?: bool|null,
 *   mime?: string|null,
 *   name?: string|null,
 *   selectedFieldsSchema?: array<string,SelectedFieldsSchema>|null,
 *   size?: float|null,
 *   tags?: list<string>|null,
 *   thumbnail?: string|null,
 *   type?: value-of<Type>|null,
 *   updatedAt?: \DateTimeInterface|null,
 *   url?: string|null,
 *   versionInfo?: VersionInfo|null,
 *   width?: float|null,
 * }
 */
final class File implements BaseModel
{
    /** @use SdkModel<FileShape> */
    use SdkModel;

    /**
     * An array of tags assigned to the file by auto tagging.
     *
     * @var list<AITag>|null $aiTags
     */
    #[Optional('AITags', list: AITag::class, nullable: true)]
    public ?array $aiTags;

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
     * @param list<AITag|array{
     *   confidence?: float|null, name?: string|null, source?: string|null
     * }>|null $aiTags
     * @param array<string,mixed> $customMetadata
     * @param array<string,SelectedFieldsSchema|array{
     *   type: value-of<SelectedFieldsSchema\Type>,
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
     * @param Type|value-of<Type> $type
     * @param VersionInfo|array{id?: string|null, name?: string|null} $versionInfo
     */
    public static function with(
        ?array $aiTags = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $customCoordinates = null,
        ?array $customMetadata = null,
        ?string $description = null,
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
        ?float $width = null,
    ): self {
        $obj = new self;

        null !== $aiTags && $obj['aiTags'] = $aiTags;
        null !== $createdAt && $obj['createdAt'] = $createdAt;
        null !== $customCoordinates && $obj['customCoordinates'] = $customCoordinates;
        null !== $customMetadata && $obj['customMetadata'] = $customMetadata;
        null !== $description && $obj['description'] = $description;
        null !== $fileID && $obj['fileID'] = $fileID;
        null !== $filePath && $obj['filePath'] = $filePath;
        null !== $fileType && $obj['fileType'] = $fileType;
        null !== $hasAlpha && $obj['hasAlpha'] = $hasAlpha;
        null !== $height && $obj['height'] = $height;
        null !== $isPrivateFile && $obj['isPrivateFile'] = $isPrivateFile;
        null !== $isPublished && $obj['isPublished'] = $isPublished;
        null !== $mime && $obj['mime'] = $mime;
        null !== $name && $obj['name'] = $name;
        null !== $selectedFieldsSchema && $obj['selectedFieldsSchema'] = $selectedFieldsSchema;
        null !== $size && $obj['size'] = $size;
        null !== $tags && $obj['tags'] = $tags;
        null !== $thumbnail && $obj['thumbnail'] = $thumbnail;
        null !== $type && $obj['type'] = $type;
        null !== $updatedAt && $obj['updatedAt'] = $updatedAt;
        null !== $url && $obj['url'] = $url;
        null !== $versionInfo && $obj['versionInfo'] = $versionInfo;
        null !== $width && $obj['width'] = $width;

        return $obj;
    }

    /**
     * An array of tags assigned to the file by auto tagging.
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
     * Date and time when the file was uploaded. The date and time is in ISO8601 format.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * An string with custom coordinates of the file.
     */
    public function withCustomCoordinates(?string $customCoordinates): self
    {
        $obj = clone $this;
        $obj['customCoordinates'] = $customCoordinates;

        return $obj;
    }

    /**
     * An object with custom metadata for the file.
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
     * Unique identifier of the asset.
     */
    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj['fileID'] = $fileID;

        return $obj;
    }

    /**
     * Path of the file. This is the path you would use in the URL to access the file. For example, if the file is at the root of the media library, the path will be `/file.jpg`. If the file is inside a folder named `images`, the path will be `/images/file.jpg`.
     */
    public function withFilePath(string $filePath): self
    {
        $obj = clone $this;
        $obj['filePath'] = $filePath;

        return $obj;
    }

    /**
     * Type of the file. Possible values are `image`, `non-image`.
     */
    public function withFileType(string $fileType): self
    {
        $obj = clone $this;
        $obj['fileType'] = $fileType;

        return $obj;
    }

    /**
     * Specifies if the image has an alpha channel.
     */
    public function withHasAlpha(bool $hasAlpha): self
    {
        $obj = clone $this;
        $obj['hasAlpha'] = $hasAlpha;

        return $obj;
    }

    /**
     * Height of the file.
     */
    public function withHeight(float $height): self
    {
        $obj = clone $this;
        $obj['height'] = $height;

        return $obj;
    }

    /**
     * Specifies if the file is private or not.
     */
    public function withIsPrivateFile(bool $isPrivateFile): self
    {
        $obj = clone $this;
        $obj['isPrivateFile'] = $isPrivateFile;

        return $obj;
    }

    /**
     * Specifies if the file is published or not.
     */
    public function withIsPublished(bool $isPublished): self
    {
        $obj = clone $this;
        $obj['isPublished'] = $isPublished;

        return $obj;
    }

    /**
     * MIME type of the file.
     */
    public function withMime(string $mime): self
    {
        $obj = clone $this;
        $obj['mime'] = $mime;

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
     *   type: value-of<SelectedFieldsSchema\Type>,
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
     * Size of the file in bytes.
     */
    public function withSize(float $size): self
    {
        $obj = clone $this;
        $obj['size'] = $size;

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
        $obj['tags'] = $tags;

        return $obj;
    }

    /**
     * URL of the thumbnail image. This URL is used to access the thumbnail image of the file in the media library.
     */
    public function withThumbnail(string $thumbnail): self
    {
        $obj = clone $this;
        $obj['thumbnail'] = $thumbnail;

        return $obj;
    }

    /**
     * Type of the asset.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * Date and time when the file was last updated. The date and time is in ISO8601 format.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj['updatedAt'] = $updatedAt;

        return $obj;
    }

    /**
     * URL of the file.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }

    /**
     * An object with details of the file version.
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
     * Width of the file.
     */
    public function withWidth(float $width): self
    {
        $obj = clone $this;
        $obj['width'] = $width;

        return $obj;
    }
}
