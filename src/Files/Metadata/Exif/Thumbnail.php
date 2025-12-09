<?php

declare(strict_types=1);

namespace Imagekit\Files\Metadata\Exif;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Object containing Thumbnail information.
 *
 * @phpstan-type ThumbnailShape = array{
 *   compression?: int|null,
 *   resolutionUnit?: int|null,
 *   thumbnailLength?: int|null,
 *   thumbnailOffset?: int|null,
 *   xResolution?: int|null,
 *   yResolution?: int|null,
 * }
 */
final class Thumbnail implements BaseModel
{
    /** @use SdkModel<ThumbnailShape> */
    use SdkModel;

    #[Optional('Compression')]
    public ?int $compression;

    #[Optional('ResolutionUnit')]
    public ?int $resolutionUnit;

    #[Optional('ThumbnailLength')]
    public ?int $thumbnailLength;

    #[Optional('ThumbnailOffset')]
    public ?int $thumbnailOffset;

    #[Optional('XResolution')]
    public ?int $xResolution;

    #[Optional('YResolution')]
    public ?int $yResolution;

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
        ?int $compression = null,
        ?int $resolutionUnit = null,
        ?int $thumbnailLength = null,
        ?int $thumbnailOffset = null,
        ?int $xResolution = null,
        ?int $yResolution = null,
    ): self {
        $obj = new self;

        null !== $compression && $obj['compression'] = $compression;
        null !== $resolutionUnit && $obj['resolutionUnit'] = $resolutionUnit;
        null !== $thumbnailLength && $obj['thumbnailLength'] = $thumbnailLength;
        null !== $thumbnailOffset && $obj['thumbnailOffset'] = $thumbnailOffset;
        null !== $xResolution && $obj['xResolution'] = $xResolution;
        null !== $yResolution && $obj['yResolution'] = $yResolution;

        return $obj;
    }

    public function withCompression(int $compression): self
    {
        $obj = clone $this;
        $obj['compression'] = $compression;

        return $obj;
    }

    public function withResolutionUnit(int $resolutionUnit): self
    {
        $obj = clone $this;
        $obj['resolutionUnit'] = $resolutionUnit;

        return $obj;
    }

    public function withThumbnailLength(int $thumbnailLength): self
    {
        $obj = clone $this;
        $obj['thumbnailLength'] = $thumbnailLength;

        return $obj;
    }

    public function withThumbnailOffset(int $thumbnailOffset): self
    {
        $obj = clone $this;
        $obj['thumbnailOffset'] = $thumbnailOffset;

        return $obj;
    }

    public function withXResolution(int $xResolution): self
    {
        $obj = clone $this;
        $obj['xResolution'] = $xResolution;

        return $obj;
    }

    public function withYResolution(int $yResolution): self
    {
        $obj = clone $this;
        $obj['yResolution'] = $yResolution;

        return $obj;
    }
}
