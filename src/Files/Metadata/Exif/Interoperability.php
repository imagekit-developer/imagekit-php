<?php

declare(strict_types=1);

namespace Imagekit\Files\Metadata\Exif;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * JSON object.
 *
 * @phpstan-type InteroperabilityShape = array{
 *   interopIndex?: string|null, interopVersion?: string|null
 * }
 */
final class Interoperability implements BaseModel
{
    /** @use SdkModel<InteroperabilityShape> */
    use SdkModel;

    #[Optional('InteropIndex')]
    public ?string $interopIndex;

    #[Optional('InteropVersion')]
    public ?string $interopVersion;

    public function __construct()
    {
        $this->initialize();
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

        null !== $interopIndex && $obj['interopIndex'] = $interopIndex;
        null !== $interopVersion && $obj['interopVersion'] = $interopVersion;

        return $obj;
    }

    public function withInteropIndex(string $interopIndex): self
    {
        $obj = clone $this;
        $obj['interopIndex'] = $interopIndex;

        return $obj;
    }

    public function withInteropVersion(string $interopVersion): self
    {
        $obj = clone $this;
        $obj['interopVersion'] = $interopVersion;

        return $obj;
    }
}
