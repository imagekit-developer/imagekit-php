<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\Folder\Type;

/**
 * @phpstan-type FolderShape = array{
 *   id?: string|null,
 *   createdAt?: \DateTimeInterface|null,
 *   customMetadata?: array<string,mixed>|null,
 *   name?: string|null,
 *   path?: string|null,
 *   type?: null|Type|value-of<Type>,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class Folder implements BaseModel
{
    /** @use SdkModel<FolderShape> */
    use SdkModel;

    /**
     * Unique identifier of the asset.
     */
    #[Optional]
    public ?string $id;

    /**
     * Date and time when the folder was created. The date and time is in ISO8601 format.
     */
    #[Optional('created_at')]
    public ?\DateTimeInterface $createdAt;

    /**
     * An object with custom metadata for the folder. Returns empty object if no custom metadata is set.
     *
     * @var array<string,mixed>|null $customMetadata
     */
    #[Optional('custom_metadata', map: 'mixed')]
    public ?array $customMetadata;

    /**
     * Name of the asset.
     */
    #[Optional]
    public ?string $name;

    /**
     * Path of the folder. This is the path you would use in the URL to access the folder. For example, if the folder is at the root of the media library, the path will be `/folder`. If the folder is inside another folder named `images`, the path will be `/images/folder`.
     */
    #[Optional]
    public ?string $path;

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
    #[Optional('updated_at')]
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
        ?string $id = null,
        ?\DateTimeInterface $createdAt = null,
        ?array $customMetadata = null,
        ?string $name = null,
        ?string $path = null,
        Type|string|null $type = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $customMetadata && $self['customMetadata'] = $customMetadata;
        null !== $name && $self['name'] = $name;
        null !== $path && $self['path'] = $path;
        null !== $type && $self['type'] = $type;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

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
     * Name of the asset.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Path of the folder. This is the path you would use in the URL to access the folder. For example, if the folder is at the root of the media library, the path will be `/folder`. If the folder is inside another folder named `images`, the path will be `/images/folder`.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

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
