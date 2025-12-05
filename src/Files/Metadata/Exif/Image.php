<?php

declare(strict_types=1);

namespace ImageKit\Files\Metadata\Exif;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing EXIF image information.
 *
 * @phpstan-type ImageShape = array{
 *   ExifOffset?: int|null,
 *   GPSInfo?: int|null,
 *   Make?: string|null,
 *   Model?: string|null,
 *   ModifyDate?: string|null,
 *   Orientation?: int|null,
 *   ResolutionUnit?: int|null,
 *   Software?: string|null,
 *   XResolution?: int|null,
 *   YCbCrPositioning?: int|null,
 *   YResolution?: int|null,
 * }
 */
final class Image implements BaseModel
{
    /** @use SdkModel<ImageShape> */
    use SdkModel;

    #[Api(optional: true)]
    public ?int $ExifOffset;

    #[Api(optional: true)]
    public ?int $GPSInfo;

    #[Api(optional: true)]
    public ?string $Make;

    #[Api(optional: true)]
    public ?string $Model;

    #[Api(optional: true)]
    public ?string $ModifyDate;

    #[Api(optional: true)]
    public ?int $Orientation;

    #[Api(optional: true)]
    public ?int $ResolutionUnit;

    #[Api(optional: true)]
    public ?string $Software;

    #[Api(optional: true)]
    public ?int $XResolution;

    #[Api(optional: true)]
    public ?int $YCbCrPositioning;

    #[Api(optional: true)]
    public ?int $YResolution;

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
        ?int $ExifOffset = null,
        ?int $GPSInfo = null,
        ?string $Make = null,
        ?string $Model = null,
        ?string $ModifyDate = null,
        ?int $Orientation = null,
        ?int $ResolutionUnit = null,
        ?string $Software = null,
        ?int $XResolution = null,
        ?int $YCbCrPositioning = null,
        ?int $YResolution = null,
    ): self {
        $obj = new self;

        null !== $ExifOffset && $obj['ExifOffset'] = $ExifOffset;
        null !== $GPSInfo && $obj['GPSInfo'] = $GPSInfo;
        null !== $Make && $obj['Make'] = $Make;
        null !== $Model && $obj['Model'] = $Model;
        null !== $ModifyDate && $obj['ModifyDate'] = $ModifyDate;
        null !== $Orientation && $obj['Orientation'] = $Orientation;
        null !== $ResolutionUnit && $obj['ResolutionUnit'] = $ResolutionUnit;
        null !== $Software && $obj['Software'] = $Software;
        null !== $XResolution && $obj['XResolution'] = $XResolution;
        null !== $YCbCrPositioning && $obj['YCbCrPositioning'] = $YCbCrPositioning;
        null !== $YResolution && $obj['YResolution'] = $YResolution;

        return $obj;
    }

    public function withExifOffset(int $exifOffset): self
    {
        $obj = clone $this;
        $obj['ExifOffset'] = $exifOffset;

        return $obj;
    }

    public function withGpsInfo(int $gpsInfo): self
    {
        $obj = clone $this;
        $obj['GPSInfo'] = $gpsInfo;

        return $obj;
    }

    public function withMake(string $make): self
    {
        $obj = clone $this;
        $obj['Make'] = $make;

        return $obj;
    }

    public function withModel(string $model): self
    {
        $obj = clone $this;
        $obj['Model'] = $model;

        return $obj;
    }

    public function withModifyDate(string $modifyDate): self
    {
        $obj = clone $this;
        $obj['ModifyDate'] = $modifyDate;

        return $obj;
    }

    public function withOrientation(int $orientation): self
    {
        $obj = clone $this;
        $obj['Orientation'] = $orientation;

        return $obj;
    }

    public function withResolutionUnit(int $resolutionUnit): self
    {
        $obj = clone $this;
        $obj['ResolutionUnit'] = $resolutionUnit;

        return $obj;
    }

    public function withSoftware(string $software): self
    {
        $obj = clone $this;
        $obj['Software'] = $software;

        return $obj;
    }

    public function withXResolution(int $xResolution): self
    {
        $obj = clone $this;
        $obj['XResolution'] = $xResolution;

        return $obj;
    }

    public function withYCbCrPositioning(int $yCbCrPositioning): self
    {
        $obj = clone $this;
        $obj['YCbCrPositioning'] = $yCbCrPositioning;

        return $obj;
    }

    public function withYResolution(int $yResolution): self
    {
        $obj = clone $this;
        $obj['YResolution'] = $yResolution;

        return $obj;
    }
}
