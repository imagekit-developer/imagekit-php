<?php

declare(strict_types=1);

namespace ImageKit\Files\Metadata\Exif;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing Thumbnail information.
 *
 * @phpstan-type ThumbnailShape = array{
 *   compression?: int|null,
 *   resolutionUnit?: int|null,
 *   thumbnailLength?: int|null,
 *   thumbnailOffset?: int|null,
 *   xResolution?: float|null,
 *   yResolution?: float|null,
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
    public ?float $xResolution;

    #[Optional('YResolution')]
    public ?float $yResolution;

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
        ?float $xResolution = null,
        ?float $yResolution = null,
    ): self {
        $self = new self;

        null !== $compression && $self['compression'] = $compression;
        null !== $resolutionUnit && $self['resolutionUnit'] = $resolutionUnit;
        null !== $thumbnailLength && $self['thumbnailLength'] = $thumbnailLength;
        null !== $thumbnailOffset && $self['thumbnailOffset'] = $thumbnailOffset;
        null !== $xResolution && $self['xResolution'] = $xResolution;
        null !== $yResolution && $self['yResolution'] = $yResolution;

        return $self;
    }

    public function withCompression(int $compression): self
    {
        $self = clone $this;
        $self['compression'] = $compression;

        return $self;
    }

    public function withResolutionUnit(int $resolutionUnit): self
    {
        $self = clone $this;
        $self['resolutionUnit'] = $resolutionUnit;

        return $self;
    }

    public function withThumbnailLength(int $thumbnailLength): self
    {
        $self = clone $this;
        $self['thumbnailLength'] = $thumbnailLength;

        return $self;
    }

    public function withThumbnailOffset(int $thumbnailOffset): self
    {
        $self = clone $this;
        $self['thumbnailOffset'] = $thumbnailOffset;

        return $self;
    }

    public function withXResolution(float $xResolution): self
    {
        $self = clone $this;
        $self['xResolution'] = $xResolution;

        return $self;
    }

    public function withYResolution(float $yResolution): self
    {
        $self = clone $this;
        $self['yResolution'] = $yResolution;

        return $self;
    }
}
