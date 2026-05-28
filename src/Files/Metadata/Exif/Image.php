<?php

declare(strict_types=1);

namespace ImageKit\Files\Metadata\Exif;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing EXIF image information.
 *
 * @phpstan-type ImageShape = array{
 *   artist?: string|null,
 *   copyright?: string|null,
 *   exifOffset?: int|null,
 *   gpsInfo?: int|null,
 *   imageDescription?: string|null,
 *   make?: string|null,
 *   model?: string|null,
 *   modifyDate?: string|null,
 *   orientation?: int|null,
 *   resolutionUnit?: int|null,
 *   software?: string|null,
 *   xResolution?: float|null,
 *   yCbCrPositioning?: int|null,
 *   yResolution?: float|null,
 * }
 */
final class Image implements BaseModel
{
    /** @use SdkModel<ImageShape> */
    use SdkModel;

    #[Optional('Artist')]
    public ?string $artist;

    #[Optional('Copyright')]
    public ?string $copyright;

    #[Optional('ExifOffset')]
    public ?int $exifOffset;

    #[Optional('GPSInfo')]
    public ?int $gpsInfo;

    #[Optional('ImageDescription')]
    public ?string $imageDescription;

    #[Optional('Make')]
    public ?string $make;

    #[Optional('Model')]
    public ?string $model;

    #[Optional('ModifyDate')]
    public ?string $modifyDate;

    #[Optional('Orientation')]
    public ?int $orientation;

    #[Optional('ResolutionUnit')]
    public ?int $resolutionUnit;

    #[Optional('Software')]
    public ?string $software;

    #[Optional('XResolution')]
    public ?float $xResolution;

    #[Optional('YCbCrPositioning')]
    public ?int $yCbCrPositioning;

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
        ?string $artist = null,
        ?string $copyright = null,
        ?int $exifOffset = null,
        ?int $gpsInfo = null,
        ?string $imageDescription = null,
        ?string $make = null,
        ?string $model = null,
        ?string $modifyDate = null,
        ?int $orientation = null,
        ?int $resolutionUnit = null,
        ?string $software = null,
        ?float $xResolution = null,
        ?int $yCbCrPositioning = null,
        ?float $yResolution = null,
    ): self {
        $self = new self;

        null !== $artist && $self['artist'] = $artist;
        null !== $copyright && $self['copyright'] = $copyright;
        null !== $exifOffset && $self['exifOffset'] = $exifOffset;
        null !== $gpsInfo && $self['gpsInfo'] = $gpsInfo;
        null !== $imageDescription && $self['imageDescription'] = $imageDescription;
        null !== $make && $self['make'] = $make;
        null !== $model && $self['model'] = $model;
        null !== $modifyDate && $self['modifyDate'] = $modifyDate;
        null !== $orientation && $self['orientation'] = $orientation;
        null !== $resolutionUnit && $self['resolutionUnit'] = $resolutionUnit;
        null !== $software && $self['software'] = $software;
        null !== $xResolution && $self['xResolution'] = $xResolution;
        null !== $yCbCrPositioning && $self['yCbCrPositioning'] = $yCbCrPositioning;
        null !== $yResolution && $self['yResolution'] = $yResolution;

        return $self;
    }

    public function withArtist(string $artist): self
    {
        $self = clone $this;
        $self['artist'] = $artist;

        return $self;
    }

    public function withCopyright(string $copyright): self
    {
        $self = clone $this;
        $self['copyright'] = $copyright;

        return $self;
    }

    public function withExifOffset(int $exifOffset): self
    {
        $self = clone $this;
        $self['exifOffset'] = $exifOffset;

        return $self;
    }

    public function withGpsInfo(int $gpsInfo): self
    {
        $self = clone $this;
        $self['gpsInfo'] = $gpsInfo;

        return $self;
    }

    public function withImageDescription(string $imageDescription): self
    {
        $self = clone $this;
        $self['imageDescription'] = $imageDescription;

        return $self;
    }

    public function withMake(string $make): self
    {
        $self = clone $this;
        $self['make'] = $make;

        return $self;
    }

    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    public function withModifyDate(string $modifyDate): self
    {
        $self = clone $this;
        $self['modifyDate'] = $modifyDate;

        return $self;
    }

    public function withOrientation(int $orientation): self
    {
        $self = clone $this;
        $self['orientation'] = $orientation;

        return $self;
    }

    public function withResolutionUnit(int $resolutionUnit): self
    {
        $self = clone $this;
        $self['resolutionUnit'] = $resolutionUnit;

        return $self;
    }

    public function withSoftware(string $software): self
    {
        $self = clone $this;
        $self['software'] = $software;

        return $self;
    }

    public function withXResolution(float $xResolution): self
    {
        $self = clone $this;
        $self['xResolution'] = $xResolution;

        return $self;
    }

    public function withYCbCrPositioning(int $yCbCrPositioning): self
    {
        $self = clone $this;
        $self['yCbCrPositioning'] = $yCbCrPositioning;

        return $self;
    }

    public function withYResolution(float $yResolution): self
    {
        $self = clone $this;
        $self['yResolution'] = $yResolution;

        return $self;
    }
}
