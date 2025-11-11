<?php

declare(strict_types=1);

namespace ImageKit\Files\Metadata\Exif;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing Exif details.
 *
 * @phpstan-type ExifShape = array{
 *   ApertureValue?: float|null,
 *   ColorSpace?: int|null,
 *   CreateDate?: string|null,
 *   CustomRendered?: int|null,
 *   DateTimeOriginal?: string|null,
 *   ExifImageHeight?: int|null,
 *   ExifImageWidth?: int|null,
 *   ExifVersion?: string|null,
 *   ExposureCompensation?: float|null,
 *   ExposureMode?: int|null,
 *   ExposureProgram?: int|null,
 *   ExposureTime?: float|null,
 *   Flash?: int|null,
 *   FlashpixVersion?: string|null,
 *   FNumber?: float|null,
 *   FocalLength?: int|null,
 *   FocalPlaneResolutionUnit?: int|null,
 *   FocalPlaneXResolution?: float|null,
 *   FocalPlaneYResolution?: float|null,
 *   InteropOffset?: int|null,
 *   ISO?: int|null,
 *   MeteringMode?: int|null,
 *   SceneCaptureType?: int|null,
 *   ShutterSpeedValue?: float|null,
 *   SubSecTime?: string|null,
 *   WhiteBalance?: int|null,
 * }
 */
final class Exif implements BaseModel
{
    /** @use SdkModel<ExifShape> */
    use SdkModel;

    #[Api(optional: true)]
    public ?float $ApertureValue;

    #[Api(optional: true)]
    public ?int $ColorSpace;

    #[Api(optional: true)]
    public ?string $CreateDate;

    #[Api(optional: true)]
    public ?int $CustomRendered;

    #[Api(optional: true)]
    public ?string $DateTimeOriginal;

    #[Api(optional: true)]
    public ?int $ExifImageHeight;

    #[Api(optional: true)]
    public ?int $ExifImageWidth;

    #[Api(optional: true)]
    public ?string $ExifVersion;

    #[Api(optional: true)]
    public ?float $ExposureCompensation;

    #[Api(optional: true)]
    public ?int $ExposureMode;

    #[Api(optional: true)]
    public ?int $ExposureProgram;

    #[Api(optional: true)]
    public ?float $ExposureTime;

    #[Api(optional: true)]
    public ?int $Flash;

    #[Api(optional: true)]
    public ?string $FlashpixVersion;

    #[Api(optional: true)]
    public ?float $FNumber;

    #[Api(optional: true)]
    public ?int $FocalLength;

    #[Api(optional: true)]
    public ?int $FocalPlaneResolutionUnit;

    #[Api(optional: true)]
    public ?float $FocalPlaneXResolution;

    #[Api(optional: true)]
    public ?float $FocalPlaneYResolution;

    #[Api(optional: true)]
    public ?int $InteropOffset;

    #[Api(optional: true)]
    public ?int $ISO;

    #[Api(optional: true)]
    public ?int $MeteringMode;

    #[Api(optional: true)]
    public ?int $SceneCaptureType;

    #[Api(optional: true)]
    public ?float $ShutterSpeedValue;

    #[Api(optional: true)]
    public ?string $SubSecTime;

    #[Api(optional: true)]
    public ?int $WhiteBalance;

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
        ?float $ApertureValue = null,
        ?int $ColorSpace = null,
        ?string $CreateDate = null,
        ?int $CustomRendered = null,
        ?string $DateTimeOriginal = null,
        ?int $ExifImageHeight = null,
        ?int $ExifImageWidth = null,
        ?string $ExifVersion = null,
        ?float $ExposureCompensation = null,
        ?int $ExposureMode = null,
        ?int $ExposureProgram = null,
        ?float $ExposureTime = null,
        ?int $Flash = null,
        ?string $FlashpixVersion = null,
        ?float $FNumber = null,
        ?int $FocalLength = null,
        ?int $FocalPlaneResolutionUnit = null,
        ?float $FocalPlaneXResolution = null,
        ?float $FocalPlaneYResolution = null,
        ?int $InteropOffset = null,
        ?int $ISO = null,
        ?int $MeteringMode = null,
        ?int $SceneCaptureType = null,
        ?float $ShutterSpeedValue = null,
        ?string $SubSecTime = null,
        ?int $WhiteBalance = null,
    ): self {
        $obj = new self;

        null !== $ApertureValue && $obj->ApertureValue = $ApertureValue;
        null !== $ColorSpace && $obj->ColorSpace = $ColorSpace;
        null !== $CreateDate && $obj->CreateDate = $CreateDate;
        null !== $CustomRendered && $obj->CustomRendered = $CustomRendered;
        null !== $DateTimeOriginal && $obj->DateTimeOriginal = $DateTimeOriginal;
        null !== $ExifImageHeight && $obj->ExifImageHeight = $ExifImageHeight;
        null !== $ExifImageWidth && $obj->ExifImageWidth = $ExifImageWidth;
        null !== $ExifVersion && $obj->ExifVersion = $ExifVersion;
        null !== $ExposureCompensation && $obj->ExposureCompensation = $ExposureCompensation;
        null !== $ExposureMode && $obj->ExposureMode = $ExposureMode;
        null !== $ExposureProgram && $obj->ExposureProgram = $ExposureProgram;
        null !== $ExposureTime && $obj->ExposureTime = $ExposureTime;
        null !== $Flash && $obj->Flash = $Flash;
        null !== $FlashpixVersion && $obj->FlashpixVersion = $FlashpixVersion;
        null !== $FNumber && $obj->FNumber = $FNumber;
        null !== $FocalLength && $obj->FocalLength = $FocalLength;
        null !== $FocalPlaneResolutionUnit && $obj->FocalPlaneResolutionUnit = $FocalPlaneResolutionUnit;
        null !== $FocalPlaneXResolution && $obj->FocalPlaneXResolution = $FocalPlaneXResolution;
        null !== $FocalPlaneYResolution && $obj->FocalPlaneYResolution = $FocalPlaneYResolution;
        null !== $InteropOffset && $obj->InteropOffset = $InteropOffset;
        null !== $ISO && $obj->ISO = $ISO;
        null !== $MeteringMode && $obj->MeteringMode = $MeteringMode;
        null !== $SceneCaptureType && $obj->SceneCaptureType = $SceneCaptureType;
        null !== $ShutterSpeedValue && $obj->ShutterSpeedValue = $ShutterSpeedValue;
        null !== $SubSecTime && $obj->SubSecTime = $SubSecTime;
        null !== $WhiteBalance && $obj->WhiteBalance = $WhiteBalance;

        return $obj;
    }

    public function withApertureValue(float $apertureValue): self
    {
        $obj = clone $this;
        $obj->ApertureValue = $apertureValue;

        return $obj;
    }

    public function withColorSpace(int $colorSpace): self
    {
        $obj = clone $this;
        $obj->ColorSpace = $colorSpace;

        return $obj;
    }

    public function withCreateDate(string $createDate): self
    {
        $obj = clone $this;
        $obj->CreateDate = $createDate;

        return $obj;
    }

    public function withCustomRendered(int $customRendered): self
    {
        $obj = clone $this;
        $obj->CustomRendered = $customRendered;

        return $obj;
    }

    public function withDateTimeOriginal(string $dateTimeOriginal): self
    {
        $obj = clone $this;
        $obj->DateTimeOriginal = $dateTimeOriginal;

        return $obj;
    }

    public function withExifImageHeight(int $exifImageHeight): self
    {
        $obj = clone $this;
        $obj->ExifImageHeight = $exifImageHeight;

        return $obj;
    }

    public function withExifImageWidth(int $exifImageWidth): self
    {
        $obj = clone $this;
        $obj->ExifImageWidth = $exifImageWidth;

        return $obj;
    }

    public function withExifVersion(string $exifVersion): self
    {
        $obj = clone $this;
        $obj->ExifVersion = $exifVersion;

        return $obj;
    }

    public function withExposureCompensation(float $exposureCompensation): self
    {
        $obj = clone $this;
        $obj->ExposureCompensation = $exposureCompensation;

        return $obj;
    }

    public function withExposureMode(int $exposureMode): self
    {
        $obj = clone $this;
        $obj->ExposureMode = $exposureMode;

        return $obj;
    }

    public function withExposureProgram(int $exposureProgram): self
    {
        $obj = clone $this;
        $obj->ExposureProgram = $exposureProgram;

        return $obj;
    }

    public function withExposureTime(float $exposureTime): self
    {
        $obj = clone $this;
        $obj->ExposureTime = $exposureTime;

        return $obj;
    }

    public function withFlash(int $flash): self
    {
        $obj = clone $this;
        $obj->Flash = $flash;

        return $obj;
    }

    public function withFlashpixVersion(string $flashpixVersion): self
    {
        $obj = clone $this;
        $obj->FlashpixVersion = $flashpixVersion;

        return $obj;
    }

    public function withFNumber(float $fNumber): self
    {
        $obj = clone $this;
        $obj->FNumber = $fNumber;

        return $obj;
    }

    public function withFocalLength(int $focalLength): self
    {
        $obj = clone $this;
        $obj->FocalLength = $focalLength;

        return $obj;
    }

    public function withFocalPlaneResolutionUnit(
        int $focalPlaneResolutionUnit
    ): self {
        $obj = clone $this;
        $obj->FocalPlaneResolutionUnit = $focalPlaneResolutionUnit;

        return $obj;
    }

    public function withFocalPlaneXResolution(
        float $focalPlaneXResolution
    ): self {
        $obj = clone $this;
        $obj->FocalPlaneXResolution = $focalPlaneXResolution;

        return $obj;
    }

    public function withFocalPlaneYResolution(
        float $focalPlaneYResolution
    ): self {
        $obj = clone $this;
        $obj->FocalPlaneYResolution = $focalPlaneYResolution;

        return $obj;
    }

    public function withInteropOffset(int $interopOffset): self
    {
        $obj = clone $this;
        $obj->InteropOffset = $interopOffset;

        return $obj;
    }

    public function withISO(int $iso): self
    {
        $obj = clone $this;
        $obj->ISO = $iso;

        return $obj;
    }

    public function withMeteringMode(int $meteringMode): self
    {
        $obj = clone $this;
        $obj->MeteringMode = $meteringMode;

        return $obj;
    }

    public function withSceneCaptureType(int $sceneCaptureType): self
    {
        $obj = clone $this;
        $obj->SceneCaptureType = $sceneCaptureType;

        return $obj;
    }

    public function withShutterSpeedValue(float $shutterSpeedValue): self
    {
        $obj = clone $this;
        $obj->ShutterSpeedValue = $shutterSpeedValue;

        return $obj;
    }

    public function withSubSecTime(string $subSecTime): self
    {
        $obj = clone $this;
        $obj->SubSecTime = $subSecTime;

        return $obj;
    }

    public function withWhiteBalance(int $whiteBalance): self
    {
        $obj = clone $this;
        $obj->WhiteBalance = $whiteBalance;

        return $obj;
    }
}
