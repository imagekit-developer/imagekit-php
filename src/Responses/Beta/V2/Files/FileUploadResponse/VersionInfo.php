<?php

declare(strict_types=1);

namespace ImageKit\Responses\Beta\V2\Files\FileUploadResponse;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * An object containing the file or file version's `id` (versionId) and `name`.
 *
 * @phpstan-type version_info_alias = array{id?: string, name?: string}
 */
final class VersionInfo implements BaseModel
{
    use SdkModel;

    /**
     * Unique identifier of the file version.
     */
    #[Api(optional: true)]
    public ?string $id;

    /**
     * Name of the file version.
     */
    #[Api(optional: true)]
    public ?string $name;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $id = null, ?string $name = null): self
    {
        $obj = new self;

        null !== $id && $obj->id = $id;
        null !== $name && $obj->name = $name;

        return $obj;
    }

    /**
     * Unique identifier of the file version.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * Name of the file version.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
