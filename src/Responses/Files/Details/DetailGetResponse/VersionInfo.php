<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Details\DetailGetResponse;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * An object with details of the file version.
 *
 * @phpstan-type version_info_alias = array{id?: string, name?: string}
 */
final class VersionInfo implements BaseModel
{
    use Model;

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
    public static function new(?string $id = null, ?string $name = null): self
    {
        $obj = new self;

        null !== $id && $obj->id = $id;
        null !== $name && $obj->name = $name;

        return $obj;
    }

    /**
     * Unique identifier of the file version.
     */
    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Name of the file version.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
