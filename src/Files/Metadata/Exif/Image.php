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

    #[Optional]
    public ?int $ExifOffset;

    #[Optional]
    public ?int $GPSInfo;

    #[Optional]
    public ?string $Make;

    #[Optional]
    public ?string $Model;

    #[Optional]
    public ?string $ModifyDate;

    #[Optional]
    public ?int $Orientation;

    #[Optional]
    public ?int $ResolutionUnit;

    #[Optional]
    public ?string $Software;

    #[Optional]
    public ?int $XResolution;

    #[Optional]
    public ?int $YCbCrPositioning;

    #[Optional]
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
