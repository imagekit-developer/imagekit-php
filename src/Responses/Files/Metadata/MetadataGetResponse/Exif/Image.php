<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Metadata\MetadataGetResponse\Exif;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing EXIF image information.
 *
 * @phpstan-type image_alias = array{
 *   exifOffset?: int,
 *   gpsInfo?: int,
 *   make?: string,
 *   model?: string,
 *   modifyDate?: string,
 *   orientation?: int,
 *   resolutionUnit?: int,
 *   software?: string,
 *   xResolution?: int,
 *   yCbCrPositioning?: int,
 *   yResolution?: int,
 * }
 */
final class Image implements BaseModel
{
    use SdkModel;

    #[Api('ExifOffset', optional: true)]
    public ?int $exifOffset;

    #[Api('GPSInfo', optional: true)]
    public ?int $gpsInfo;

    #[Api('Make', optional: true)]
    public ?string $make;

    #[Api('Model', optional: true)]
    public ?string $model;

    #[Api('ModifyDate', optional: true)]
    public ?string $modifyDate;

    #[Api('Orientation', optional: true)]
    public ?int $orientation;

    #[Api('ResolutionUnit', optional: true)]
    public ?int $resolutionUnit;

    #[Api('Software', optional: true)]
    public ?string $software;

    #[Api('XResolution', optional: true)]
    public ?int $xResolution;

    #[Api('YCbCrPositioning', optional: true)]
    public ?int $yCbCrPositioning;

    #[Api('YResolution', optional: true)]
    public ?int $yResolution;

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

        null !== $exifOffset && $obj->exifOffset = $exifOffset;
        null !== $gpsInfo && $obj->gpsInfo = $gpsInfo;
        null !== $make && $obj->make = $make;
        null !== $model && $obj->model = $model;
        null !== $modifyDate && $obj->modifyDate = $modifyDate;
        null !== $orientation && $obj->orientation = $orientation;
        null !== $resolutionUnit && $obj->resolutionUnit = $resolutionUnit;
        null !== $software && $obj->software = $software;
        null !== $xResolution && $obj->xResolution = $xResolution;
        null !== $yCbCrPositioning && $obj->yCbCrPositioning = $yCbCrPositioning;
        null !== $yResolution && $obj->yResolution = $yResolution;

        return $obj;
    }

    public function withExifOffset(int $exifOffset): self
    {
        $obj = clone $this;
        $obj->exifOffset = $exifOffset;

        return $obj;
    }

    public function withGpsInfo(int $gpsInfo): self
    {
        $obj = clone $this;
        $obj->gpsInfo = $gpsInfo;

        return $obj;
    }

    public function withMake(string $make): self
    {
        $obj = clone $this;
        $obj->make = $make;

        return $obj;
    }

    public function withModel(string $model): self
    {
        $obj = clone $this;
        $obj->model = $model;

        return $obj;
    }

    public function withModifyDate(string $modifyDate): self
    {
        $obj = clone $this;
        $obj->modifyDate = $modifyDate;

        return $obj;
    }

    public function withOrientation(int $orientation): self
    {
        $obj = clone $this;
        $obj->orientation = $orientation;

        return $obj;
    }

    public function withResolutionUnit(int $resolutionUnit): self
    {
        $obj = clone $this;
        $obj->resolutionUnit = $resolutionUnit;

        return $obj;
    }

    public function withSoftware(string $software): self
    {
        $obj = clone $this;
        $obj->software = $software;

        return $obj;
    }

    public function withXResolution(int $xResolution): self
    {
        $obj = clone $this;
        $obj->xResolution = $xResolution;

        return $obj;
    }

    public function withYCbCrPositioning(int $yCbCrPositioning): self
    {
        $obj = clone $this;
        $obj->yCbCrPositioning = $yCbCrPositioning;

        return $obj;
    }

    public function withYResolution(int $yResolution): self
    {
        $obj = clone $this;
        $obj->yResolution = $yResolution;

        return $obj;
    }
}
