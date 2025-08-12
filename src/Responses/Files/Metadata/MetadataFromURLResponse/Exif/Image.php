<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Metadata\MetadataFromURLResponse\Exif;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
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
    use Model;

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
    public static function new(
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

    public function setExifOffset(int $exifOffset): self
    {
        $this->exifOffset = $exifOffset;

        return $this;
    }

    public function setGpsInfo(int $gpsInfo): self
    {
        $this->gpsInfo = $gpsInfo;

        return $this;
    }

    public function setMake(string $make): self
    {
        $this->make = $make;

        return $this;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function setModifyDate(string $modifyDate): self
    {
        $this->modifyDate = $modifyDate;

        return $this;
    }

    public function setOrientation(int $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function setResolutionUnit(int $resolutionUnit): self
    {
        $this->resolutionUnit = $resolutionUnit;

        return $this;
    }

    public function setSoftware(string $software): self
    {
        $this->software = $software;

        return $this;
    }

    public function setXResolution(int $xResolution): self
    {
        $this->xResolution = $xResolution;

        return $this;
    }

    public function setYCbCrPositioning(int $yCbCrPositioning): self
    {
        $this->yCbCrPositioning = $yCbCrPositioning;

        return $this;
    }

    public function setYResolution(int $yResolution): self
    {
        $this->yResolution = $yResolution;

        return $this;
    }
}
