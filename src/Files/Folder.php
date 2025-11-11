<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\Folder\Type;

/**
 * @phpstan-type FolderShape = array{
 *   createdAt?: \DateTimeInterface|null,
 *   folderId?: string|null,
 *   folderPath?: string|null,
 *   name?: string|null,
 *   type?: value-of<Type>|null,
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
    #[Api(optional: true)]
    public ?\DateTimeInterface $createdAt;

    /**
     * Unique identifier of the asset.
     */
    #[Api(optional: true)]
    public ?string $folderId;

    /**
     * Path of the folder. This is the path you would use in the URL to access the folder. For example, if the folder is at the root of the media library, the path will be /folder. If the folder is inside another folder named images, the path will be /images/folder.
     */
    #[Api(optional: true)]
    public ?string $folderPath;

    /**
     * Name of the asset.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * Type of the asset.
     *
     * @var value-of<Type>|null $type
     */
    #[Api(enum: Type::class, optional: true)]
    public ?string $type;

    /**
     * Date and time when the folder was last updated. The date and time is in ISO8601 format.
     */
    #[Api(optional: true)]
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        ?\DateTimeInterface $createdAt = null,
        ?string $folderId = null,
        ?string $folderPath = null,
        ?string $name = null,
        Type|string|null $type = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $obj = new self;

        null !== $createdAt && $obj->createdAt = $createdAt;
        null !== $folderId && $obj->folderId = $folderId;
        null !== $folderPath && $obj->folderPath = $folderPath;
        null !== $name && $obj->name = $name;
        null !== $type && $obj['type'] = $type;
        null !== $updatedAt && $obj->updatedAt = $updatedAt;

        return $obj;
    }

    /**
     * Date and time when the folder was created. The date and time is in ISO8601 format.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * Unique identifier of the asset.
     */
    public function withFolderID(string $folderID): self
    {
        $obj = clone $this;
        $obj->folderId = $folderID;

        return $obj;
    }

    /**
     * Path of the folder. This is the path you would use in the URL to access the folder. For example, if the folder is at the root of the media library, the path will be /folder. If the folder is inside another folder named images, the path will be /images/folder.
     */
    public function withFolderPath(string $folderPath): self
    {
        $obj = clone $this;
        $obj->folderPath = $folderPath;

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
     * Date and time when the folder was last updated. The date and time is in ISO8601 format.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }
}
