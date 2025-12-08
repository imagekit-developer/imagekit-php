<?php

declare(strict_types=1);

namespace Imagekit\Files\File;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * An object with details of the file version.
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
        $obj = new self;

        null !== $id && $obj['id'] = $id;
        null !== $name && $obj['name'] = $name;

        return $obj;
    }

    /**
     * Unique identifier of the file version.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * Name of the file version.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }
}
