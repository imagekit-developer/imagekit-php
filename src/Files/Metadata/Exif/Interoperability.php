<?php

declare(strict_types=1);

namespace Imagekit\Files\Metadata\Exif;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * JSON object.
 *
 * @phpstan-type InteroperabilityShape = array{
 *   InteropIndex?: string|null, InteropVersion?: string|null
 * }
 */
final class Interoperability implements BaseModel
{
    /** @use SdkModel<InteroperabilityShape> */
    use SdkModel;

    #[Api(optional: true)]
    public ?string $InteropIndex;

    #[Api(optional: true)]
    public ?string $InteropVersion;

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
        ?string $InteropIndex = null,
        ?string $InteropVersion = null
    ): self {
        $obj = new self;

        null !== $InteropIndex && $obj['InteropIndex'] = $InteropIndex;
        null !== $InteropVersion && $obj['InteropVersion'] = $InteropVersion;

        return $obj;
    }

    public function withInteropIndex(string $interopIndex): self
    {
        $obj = clone $this;
        $obj['InteropIndex'] = $interopIndex;

        return $obj;
    }

    public function withInteropVersion(string $interopVersion): self
    {
        $obj = clone $this;
        $obj['InteropVersion'] = $interopVersion;

        return $obj;
    }
}
