<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Metadata\MetadataFromURLResponse\Exif;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing Exif details.
 *
 * @phpstan-type exif_alias = array{
 *   apertureValue?: float,
 *   colorSpace?: int,
 *   createDate?: string,
 *   customRendered?: int,
 *   dateTimeOriginal?: string,
 *   exifImageHeight?: int,
 *   exifImageWidth?: int,
 *   exifVersion?: string,
 *   exposureCompensation?: float,
 *   exposureMode?: int,
 *   exposureProgram?: int,
 *   exposureTime?: float,
 *   flash?: int,
 *   flashpixVersion?: string,
 *   fNumber?: float,
 *   focalLength?: int,
 *   focalPlaneResolutionUnit?: int,
 *   focalPlaneXResolution?: float,
 *   focalPlaneYResolution?: float,
 *   interopOffset?: int,
 *   iso?: int,
 *   meteringMode?: int,
 *   sceneCaptureType?: int,
 *   shutterSpeedValue?: float,
 *   subSecTime?: string,
 *   whiteBalance?: int,
 * }
 */
final class Exif implements BaseModel
{
    use Model;

    #[Api('ApertureValue', optional: true)]
    public ?float $apertureValue;

    #[Api('ColorSpace', optional: true)]
    public ?int $colorSpace;

    #[Api('CreateDate', optional: true)]
    public ?string $createDate;

    #[Api('CustomRendered', optional: true)]
    public ?int $customRendered;

    #[Api('DateTimeOriginal', optional: true)]
    public ?string $dateTimeOriginal;

    #[Api('ExifImageHeight', optional: true)]
    public ?int $exifImageHeight;

    #[Api('ExifImageWidth', optional: true)]
    public ?int $exifImageWidth;

    #[Api('ExifVersion', optional: true)]
    public ?string $exifVersion;

    #[Api('ExposureCompensation', optional: true)]
    public ?float $exposureCompensation;

    #[Api('ExposureMode', optional: true)]
    public ?int $exposureMode;

    #[Api('ExposureProgram', optional: true)]
    public ?int $exposureProgram;

    #[Api('ExposureTime', optional: true)]
    public ?float $exposureTime;

    #[Api('Flash', optional: true)]
    public ?int $flash;

    #[Api('FlashpixVersion', optional: true)]
    public ?string $flashpixVersion;

    #[Api('FNumber', optional: true)]
    public ?float $fNumber;

    #[Api('FocalLength', optional: true)]
    public ?int $focalLength;

    #[Api('FocalPlaneResolutionUnit', optional: true)]
    public ?int $focalPlaneResolutionUnit;

    #[Api('FocalPlaneXResolution', optional: true)]
    public ?float $focalPlaneXResolution;

    #[Api('FocalPlaneYResolution', optional: true)]
    public ?float $focalPlaneYResolution;

    #[Api('InteropOffset', optional: true)]
    public ?int $interopOffset;

    #[Api('ISO', optional: true)]
    public ?int $iso;

    #[Api('MeteringMode', optional: true)]
    public ?int $meteringMode;

    #[Api('SceneCaptureType', optional: true)]
    public ?int $sceneCaptureType;

    #[Api('ShutterSpeedValue', optional: true)]
    public ?float $shutterSpeedValue;

    #[Api('SubSecTime', optional: true)]
    public ?string $subSecTime;

    #[Api('WhiteBalance', optional: true)]
    public ?int $whiteBalance;

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
        ?float $apertureValue = null,
        ?int $colorSpace = null,
        ?string $createDate = null,
        ?int $customRendered = null,
        ?string $dateTimeOriginal = null,
        ?int $exifImageHeight = null,
        ?int $exifImageWidth = null,
        ?string $exifVersion = null,
        ?float $exposureCompensation = null,
        ?int $exposureMode = null,
        ?int $exposureProgram = null,
        ?float $exposureTime = null,
        ?int $flash = null,
        ?string $flashpixVersion = null,
        ?float $fNumber = null,
        ?int $focalLength = null,
        ?int $focalPlaneResolutionUnit = null,
        ?float $focalPlaneXResolution = null,
        ?float $focalPlaneYResolution = null,
        ?int $interopOffset = null,
        ?int $iso = null,
        ?int $meteringMode = null,
        ?int $sceneCaptureType = null,
        ?float $shutterSpeedValue = null,
        ?string $subSecTime = null,
        ?int $whiteBalance = null,
    ): self {
        $obj = new self;

        null !== $apertureValue && $obj->apertureValue = $apertureValue;
        null !== $colorSpace && $obj->colorSpace = $colorSpace;
        null !== $createDate && $obj->createDate = $createDate;
        null !== $customRendered && $obj->customRendered = $customRendered;
        null !== $dateTimeOriginal && $obj->dateTimeOriginal = $dateTimeOriginal;
        null !== $exifImageHeight && $obj->exifImageHeight = $exifImageHeight;
        null !== $exifImageWidth && $obj->exifImageWidth = $exifImageWidth;
        null !== $exifVersion && $obj->exifVersion = $exifVersion;
        null !== $exposureCompensation && $obj->exposureCompensation = $exposureCompensation;
        null !== $exposureMode && $obj->exposureMode = $exposureMode;
        null !== $exposureProgram && $obj->exposureProgram = $exposureProgram;
        null !== $exposureTime && $obj->exposureTime = $exposureTime;
        null !== $flash && $obj->flash = $flash;
        null !== $flashpixVersion && $obj->flashpixVersion = $flashpixVersion;
        null !== $fNumber && $obj->fNumber = $fNumber;
        null !== $focalLength && $obj->focalLength = $focalLength;
        null !== $focalPlaneResolutionUnit && $obj->focalPlaneResolutionUnit = $focalPlaneResolutionUnit;
        null !== $focalPlaneXResolution && $obj->focalPlaneXResolution = $focalPlaneXResolution;
        null !== $focalPlaneYResolution && $obj->focalPlaneYResolution = $focalPlaneYResolution;
        null !== $interopOffset && $obj->interopOffset = $interopOffset;
        null !== $iso && $obj->iso = $iso;
        null !== $meteringMode && $obj->meteringMode = $meteringMode;
        null !== $sceneCaptureType && $obj->sceneCaptureType = $sceneCaptureType;
        null !== $shutterSpeedValue && $obj->shutterSpeedValue = $shutterSpeedValue;
        null !== $subSecTime && $obj->subSecTime = $subSecTime;
        null !== $whiteBalance && $obj->whiteBalance = $whiteBalance;

        return $obj;
    }

    public function setApertureValue(float $apertureValue): self
    {
        $this->apertureValue = $apertureValue;

        return $this;
    }

    public function setColorSpace(int $colorSpace): self
    {
        $this->colorSpace = $colorSpace;

        return $this;
    }

    public function setCreateDate(string $createDate): self
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function setCustomRendered(int $customRendered): self
    {
        $this->customRendered = $customRendered;

        return $this;
    }

    public function setDateTimeOriginal(string $dateTimeOriginal): self
    {
        $this->dateTimeOriginal = $dateTimeOriginal;

        return $this;
    }

    public function setExifImageHeight(int $exifImageHeight): self
    {
        $this->exifImageHeight = $exifImageHeight;

        return $this;
    }

    public function setExifImageWidth(int $exifImageWidth): self
    {
        $this->exifImageWidth = $exifImageWidth;

        return $this;
    }

    public function setExifVersion(string $exifVersion): self
    {
        $this->exifVersion = $exifVersion;

        return $this;
    }

    public function setExposureCompensation(float $exposureCompensation): self
    {
        $this->exposureCompensation = $exposureCompensation;

        return $this;
    }

    public function setExposureMode(int $exposureMode): self
    {
        $this->exposureMode = $exposureMode;

        return $this;
    }

    public function setExposureProgram(int $exposureProgram): self
    {
        $this->exposureProgram = $exposureProgram;

        return $this;
    }

    public function setExposureTime(float $exposureTime): self
    {
        $this->exposureTime = $exposureTime;

        return $this;
    }

    public function setFlash(int $flash): self
    {
        $this->flash = $flash;

        return $this;
    }

    public function setFlashpixVersion(string $flashpixVersion): self
    {
        $this->flashpixVersion = $flashpixVersion;

        return $this;
    }

    public function setFNumber(float $fNumber): self
    {
        $this->fNumber = $fNumber;

        return $this;
    }

    public function setFocalLength(int $focalLength): self
    {
        $this->focalLength = $focalLength;

        return $this;
    }

    public function setFocalPlaneResolutionUnit(
        int $focalPlaneResolutionUnit
    ): self {
        $this->focalPlaneResolutionUnit = $focalPlaneResolutionUnit;

        return $this;
    }

    public function setFocalPlaneXResolution(float $focalPlaneXResolution): self
    {
        $this->focalPlaneXResolution = $focalPlaneXResolution;

        return $this;
    }

    public function setFocalPlaneYResolution(float $focalPlaneYResolution): self
    {
        $this->focalPlaneYResolution = $focalPlaneYResolution;

        return $this;
    }

    public function setInteropOffset(int $interopOffset): self
    {
        $this->interopOffset = $interopOffset;

        return $this;
    }

    public function setISO(int $iso): self
    {
        $this->iso = $iso;

        return $this;
    }

    public function setMeteringMode(int $meteringMode): self
    {
        $this->meteringMode = $meteringMode;

        return $this;
    }

    public function setSceneCaptureType(int $sceneCaptureType): self
    {
        $this->sceneCaptureType = $sceneCaptureType;

        return $this;
    }

    public function setShutterSpeedValue(float $shutterSpeedValue): self
    {
        $this->shutterSpeedValue = $shutterSpeedValue;

        return $this;
    }

    public function setSubSecTime(string $subSecTime): self
    {
        $this->subSecTime = $subSecTime;

        return $this;
    }

    public function setWhiteBalance(int $whiteBalance): self
    {
        $this->whiteBalance = $whiteBalance;

        return $this;
    }
}
