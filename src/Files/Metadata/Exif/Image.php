<?php

declare(strict_types=1);

namespace Imagekit\Files\Metadata\Exif;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Object containing EXIF image information.
 *
 * @phpstan-type ImageShape = array{
 *   exifOffset?: int|null,
 *   gpsInfo?: int|null,
 *   make?: string|null,
 *   model?: string|null,
 *   modifyDate?: string|null,
 *   orientation?: int|null,
 *   resolutionUnit?: int|null,
 *   software?: string|null,
 *   xResolution?: int|null,
 *   yCbCrPositioning?: int|null,
 *   yResolution?: int|null,
 * }
 */
final class Image implements BaseModel
{
    /** @use SdkModel<ImageShape> */
    use SdkModel;

    #[Optional('ExifOffset')]
    public ?int $exifOffset;

    #[Optional('GPSInfo')]
    public ?int $gpsInfo;

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
    public ?int $xResolution;

    #[Optional('YCbCrPositioning')]
    public ?int $yCbCrPositioning;

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
        ?int $exifOffset = null,
        ?int $gpsInfo = null,
        ?string $make = null,
        ?string $model = null,
        ?string $modifyDate = null,
        ?int $orientation = null,
        ?int $resolutionUnit = null,
        ?string $software = null,
        ?int $xResolution = null,
        ?int $yCbCrPositioning = null,
        ?int $yResolution = null,
    ): self {
        $self = new self;

        null !== $exifOffset && $self['exifOffset'] = $exifOffset;
        null !== $gpsInfo && $self['gpsInfo'] = $gpsInfo;
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

    public function withXResolution(int $xResolution): self
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

    public function withYResolution(int $yResolution): self
    {
        $self = clone $this;
        $self['yResolution'] = $yResolution;

        return $self;
    }
}
