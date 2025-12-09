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
        $obj = new self;

        null !== $exifOffset && $obj['exifOffset'] = $exifOffset;
        null !== $gpsInfo && $obj['gpsInfo'] = $gpsInfo;
        null !== $make && $obj['make'] = $make;
        null !== $model && $obj['model'] = $model;
        null !== $modifyDate && $obj['modifyDate'] = $modifyDate;
        null !== $orientation && $obj['orientation'] = $orientation;
        null !== $resolutionUnit && $obj['resolutionUnit'] = $resolutionUnit;
        null !== $software && $obj['software'] = $software;
        null !== $xResolution && $obj['xResolution'] = $xResolution;
        null !== $yCbCrPositioning && $obj['yCbCrPositioning'] = $yCbCrPositioning;
        null !== $yResolution && $obj['yResolution'] = $yResolution;

        return $obj;
    }

    public function withExifOffset(int $exifOffset): self
    {
        $obj = clone $this;
        $obj['exifOffset'] = $exifOffset;

        return $obj;
    }

    public function withGpsInfo(int $gpsInfo): self
    {
        $obj = clone $this;
        $obj['gpsInfo'] = $gpsInfo;

        return $obj;
    }

    public function withMake(string $make): self
    {
        $obj = clone $this;
        $obj['make'] = $make;

        return $obj;
    }

    public function withModel(string $model): self
    {
        $obj = clone $this;
        $obj['model'] = $model;

        return $obj;
    }

    public function withModifyDate(string $modifyDate): self
    {
        $obj = clone $this;
        $obj['modifyDate'] = $modifyDate;

        return $obj;
    }

    public function withOrientation(int $orientation): self
    {
        $obj = clone $this;
        $obj['orientation'] = $orientation;

        return $obj;
    }

    public function withResolutionUnit(int $resolutionUnit): self
    {
        $obj = clone $this;
        $obj['resolutionUnit'] = $resolutionUnit;

        return $obj;
    }

    public function withSoftware(string $software): self
    {
        $obj = clone $this;
        $obj['software'] = $software;

        return $obj;
    }

    public function withXResolution(int $xResolution): self
    {
        $obj = clone $this;
        $obj['xResolution'] = $xResolution;

        return $obj;
    }

    public function withYCbCrPositioning(int $yCbCrPositioning): self
    {
        $obj = clone $this;
        $obj['yCbCrPositioning'] = $yCbCrPositioning;

        return $obj;
    }

    public function withYResolution(int $yResolution): self
    {
        $obj = clone $this;
        $obj['yResolution'] = $yResolution;

        return $obj;
    }
}
