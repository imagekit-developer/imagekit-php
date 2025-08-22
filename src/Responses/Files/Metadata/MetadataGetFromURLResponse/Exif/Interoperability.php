<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Metadata\MetadataGetFromURLResponse\Exif;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
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
    use SdkModel;

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
    public static function with(
        ?string $interopIndex = null,
        ?string $interopVersion = null
    ): self {
        $obj = new self;

        null !== $interopIndex && $obj->interopIndex = $interopIndex;
        null !== $interopVersion && $obj->interopVersion = $interopVersion;

        return $obj;
    }

    public function withInteropIndex(string $interopIndex): self
    {
        $obj = clone $this;
        $obj->interopIndex = $interopIndex;

        return $obj;
    }

    public function withInteropVersion(string $interopVersion): self
    {
        $obj = clone $this;
        $obj->interopVersion = $interopVersion;

        return $obj;
    }
}
