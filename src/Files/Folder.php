<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\Folder\Type;

/**
 * @phpstan-type FolderShape = array{
 *   createdAt?: \DateTimeInterface|null,
 *   customMetadata?: array<string,mixed>|null,
 *   folderID?: string|null,
 *   folderPath?: string|null,
 *   name?: string|null,
 *   type?: null|Type|value-of<Type>,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class Folder implements BaseModel
{
    /** @use SdkModel<FolderShape> */
    use SdkModel;

    /**
     * Date and time when the folder was created. The date and time is in ISO8601 format.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * An object with custom metadata for the folder. Returns empty object if no custom metadata is set.
     *
     * @var array<string,mixed>|null $customMetadata
     */
    #[Optional(map: 'mixed')]
    public ?array $customMetadata;

    /**
     * Unique identifier of the asset.
     */
    #[Optional('folderId')]
    public ?string $folderID;

    /**
     * Path of the folder. This is the path you would use in the URL to access the folder. For example, if the folder is at the root of the media library, the path will be /folder. If the folder is inside another folder named images, the path will be /images/folder.
     */
    #[Optional]
    public ?string $folderPath;

    /**
     * Name of the asset.
     */
    #[Optional]
    public ?string $name;

    /**
     * Type of the asset.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * Date and time when the folder was last updated. The date and time is in ISO8601 format.
     */
    #[Optional]
    public ?\DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $customMetadata
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?\DateTimeInterface $createdAt = null,
        ?array $customMetadata = null,
        ?string $folderID = null,
        ?string $folderPath = null,
        ?string $name = null,
        Type|string|null $type = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $customMetadata && $self['customMetadata'] = $customMetadata;
        null !== $folderID && $self['folderID'] = $folderID;
        null !== $folderPath && $self['folderPath'] = $folderPath;
        null !== $name && $self['name'] = $name;
        null !== $type && $self['type'] = $type;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Date and time when the folder was created. The date and time is in ISO8601 format.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * An object with custom metadata for the folder. Returns empty object if no custom metadata is set.
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
     * Unique identifier of the asset.
     */
    public function withFolderID(string $folderID): self
    {
        $self = clone $this;
        $self['folderID'] = $folderID;

        return $self;
    }

    /**
     * Path of the folder. This is the path you would use in the URL to access the folder. For example, if the folder is at the root of the media library, the path will be /folder. If the folder is inside another folder named images, the path will be /images/folder.
     */
    public function withFolderPath(string $folderPath): self
    {
        $self = clone $this;
        $self['folderPath'] = $folderPath;

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
     * Date and time when the folder was last updated. The date and time is in ISO8601 format.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
