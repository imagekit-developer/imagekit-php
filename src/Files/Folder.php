<?php

declare(strict_types=1);

namespace Imagekit\Files;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Files\Folder\Type;

/**
 * @phpstan-type FolderShape = array{
 *   createdAt?: \DateTimeInterface|null,
 *   folderID?: string|null,
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
    #[Optional]
    public ?\DateTimeInterface $createdAt;

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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        ?\DateTimeInterface $createdAt = null,
        ?string $folderID = null,
        ?string $folderPath = null,
        ?string $name = null,
        Type|string|null $type = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $obj = new self;

        null !== $createdAt && $obj['createdAt'] = $createdAt;
        null !== $folderID && $obj['folderID'] = $folderID;
        null !== $folderPath && $obj['folderPath'] = $folderPath;
        null !== $name && $obj['name'] = $name;
        null !== $type && $obj['type'] = $type;
        null !== $updatedAt && $obj['updatedAt'] = $updatedAt;

        return $obj;
    }

    /**
     * Date and time when the folder was created. The date and time is in ISO8601 format.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * Unique identifier of the asset.
     */
    public function withFolderID(string $folderID): self
    {
        $obj = clone $this;
        $obj['folderID'] = $folderID;

        return $obj;
    }

    /**
     * Path of the folder. This is the path you would use in the URL to access the folder. For example, if the folder is at the root of the media library, the path will be /folder. If the folder is inside another folder named images, the path will be /images/folder.
     */
    public function withFolderPath(string $folderPath): self
    {
        $obj = clone $this;
        $obj['folderPath'] = $folderPath;

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
        $obj['updatedAt'] = $updatedAt;

        return $obj;
    }
}
