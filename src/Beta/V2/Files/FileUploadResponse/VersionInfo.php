<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files\FileUploadResponse;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * An object containing the file or file version's `id` (versionId) and `name`.
 *
 * @phpstan-type VersionInfoShape = array{id?: string|null, name?: string|null}
 */
final class VersionInfo implements BaseModel
{
    /** @use SdkModel<VersionInfoShape> */
    use SdkModel;

    /**
     * Unique identifier of the file version.
     */
    #[Optional]
    public ?string $id;

    /**
     * Name of the file version.
     */
    #[Optional]
    public ?string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $id = null, ?string $name = null): self
    {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Unique identifier of the file version.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Name of the file version.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
