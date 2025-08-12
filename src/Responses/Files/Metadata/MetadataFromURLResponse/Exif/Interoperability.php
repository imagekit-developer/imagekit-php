<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Metadata\MetadataFromURLResponse\Exif;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * JSON object.
 *
 * @phpstan-type interoperability_alias = array{
 *   interopIndex?: string, interopVersion?: string
 * }
 */
final class Interoperability implements BaseModel
{
    use Model;

    #[Api('InteropIndex', optional: true)]
    public ?string $interopIndex;

    #[Api('InteropVersion', optional: true)]
    public ?string $interopVersion;

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
    public static function from(
        ?string $interopIndex = null,
        ?string $interopVersion = null
    ): self {
        $obj = new self;

        null !== $interopIndex && $obj->interopIndex = $interopIndex;
        null !== $interopVersion && $obj->interopVersion = $interopVersion;

        return $obj;
    }

    public function setInteropIndex(string $interopIndex): self
    {
        $this->interopIndex = $interopIndex;

        return $this;
    }

    public function setInteropVersion(string $interopVersion): self
    {
        $this->interopVersion = $interopVersion;

        return $this;
    }
}
