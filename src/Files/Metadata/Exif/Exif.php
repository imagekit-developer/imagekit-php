<?php

declare(strict_types=1);

namespace Imagekit\Files\Metadata\Exif;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Object containing Exif details.
 *
 * @phpstan-type ExifShape = array{
 *   apertureValue?: float|null,
 *   colorSpace?: int|null,
 *   createDate?: string|null,
 *   customRendered?: int|null,
 *   dateTimeOriginal?: string|null,
 *   exifImageHeight?: int|null,
 *   exifImageWidth?: int|null,
 *   exifVersion?: string|null,
 *   exposureCompensation?: float|null,
 *   exposureMode?: int|null,
 *   exposureProgram?: int|null,
 *   exposureTime?: float|null,
 *   flash?: int|null,
 *   flashpixVersion?: string|null,
 *   fNumber?: float|null,
 *   focalLength?: int|null,
 *   focalPlaneResolutionUnit?: int|null,
 *   focalPlaneXResolution?: float|null,
 *   focalPlaneYResolution?: float|null,
 *   interopOffset?: int|null,
 *   iso?: int|null,
 *   meteringMode?: int|null,
 *   sceneCaptureType?: int|null,
 *   shutterSpeedValue?: float|null,
 *   subSecTime?: string|null,
 *   whiteBalance?: int|null,
 * }
 */
final class Exif implements BaseModel
{
    /** @use SdkModel<ExifShape> */
    use SdkModel;

    #[Optional('ApertureValue')]
    public ?float $apertureValue;

    #[Optional('ColorSpace')]
    public ?int $colorSpace;

    #[Optional('CreateDate')]
    public ?string $createDate;

    #[Optional('CustomRendered')]
    public ?int $customRendered;

    #[Optional('DateTimeOriginal')]
    public ?string $dateTimeOriginal;

    #[Optional('ExifImageHeight')]
    public ?int $exifImageHeight;

    #[Optional('ExifImageWidth')]
    public ?int $exifImageWidth;

    #[Optional('ExifVersion')]
    public ?string $exifVersion;

    #[Optional('ExposureCompensation')]
    public ?float $exposureCompensation;

    #[Optional('ExposureMode')]
    public ?int $exposureMode;

    #[Optional('ExposureProgram')]
    public ?int $exposureProgram;

    #[Optional('ExposureTime')]
    public ?float $exposureTime;

    #[Optional('Flash')]
    public ?int $flash;

    #[Optional('FlashpixVersion')]
    public ?string $flashpixVersion;

    #[Optional('FNumber')]
    public ?float $fNumber;

    #[Optional('FocalLength')]
    public ?int $focalLength;

    #[Optional('FocalPlaneResolutionUnit')]
    public ?int $focalPlaneResolutionUnit;

    #[Optional('FocalPlaneXResolution')]
    public ?float $focalPlaneXResolution;

    #[Optional('FocalPlaneYResolution')]
    public ?float $focalPlaneYResolution;

    #[Optional('InteropOffset')]
    public ?int $interopOffset;

    #[Optional('ISO')]
    public ?int $iso;

    #[Optional('MeteringMode')]
    public ?int $meteringMode;

    #[Optional('SceneCaptureType')]
    public ?int $sceneCaptureType;

    #[Optional('ShutterSpeedValue')]
    public ?float $shutterSpeedValue;

    #[Optional('SubSecTime')]
    public ?string $subSecTime;

    #[Optional('WhiteBalance')]
    public ?int $whiteBalance;

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

        null !== $apertureValue && $obj['apertureValue'] = $apertureValue;
        null !== $colorSpace && $obj['colorSpace'] = $colorSpace;
        null !== $createDate && $obj['createDate'] = $createDate;
        null !== $customRendered && $obj['customRendered'] = $customRendered;
        null !== $dateTimeOriginal && $obj['dateTimeOriginal'] = $dateTimeOriginal;
        null !== $exifImageHeight && $obj['exifImageHeight'] = $exifImageHeight;
        null !== $exifImageWidth && $obj['exifImageWidth'] = $exifImageWidth;
        null !== $exifVersion && $obj['exifVersion'] = $exifVersion;
        null !== $exposureCompensation && $obj['exposureCompensation'] = $exposureCompensation;
        null !== $exposureMode && $obj['exposureMode'] = $exposureMode;
        null !== $exposureProgram && $obj['exposureProgram'] = $exposureProgram;
        null !== $exposureTime && $obj['exposureTime'] = $exposureTime;
        null !== $flash && $obj['flash'] = $flash;
        null !== $flashpixVersion && $obj['flashpixVersion'] = $flashpixVersion;
        null !== $fNumber && $obj['fNumber'] = $fNumber;
        null !== $focalLength && $obj['focalLength'] = $focalLength;
        null !== $focalPlaneResolutionUnit && $obj['focalPlaneResolutionUnit'] = $focalPlaneResolutionUnit;
        null !== $focalPlaneXResolution && $obj['focalPlaneXResolution'] = $focalPlaneXResolution;
        null !== $focalPlaneYResolution && $obj['focalPlaneYResolution'] = $focalPlaneYResolution;
        null !== $interopOffset && $obj['interopOffset'] = $interopOffset;
        null !== $iso && $obj['iso'] = $iso;
        null !== $meteringMode && $obj['meteringMode'] = $meteringMode;
        null !== $sceneCaptureType && $obj['sceneCaptureType'] = $sceneCaptureType;
        null !== $shutterSpeedValue && $obj['shutterSpeedValue'] = $shutterSpeedValue;
        null !== $subSecTime && $obj['subSecTime'] = $subSecTime;
        null !== $whiteBalance && $obj['whiteBalance'] = $whiteBalance;

        return $obj;
    }

    public function withApertureValue(float $apertureValue): self
    {
        $obj = clone $this;
        $obj['apertureValue'] = $apertureValue;

        return $obj;
    }

    public function withColorSpace(int $colorSpace): self
    {
        $obj = clone $this;
        $obj['colorSpace'] = $colorSpace;

        return $obj;
    }

    public function withCreateDate(string $createDate): self
    {
        $obj = clone $this;
        $obj['createDate'] = $createDate;

        return $obj;
    }

    public function withCustomRendered(int $customRendered): self
    {
        $obj = clone $this;
        $obj['customRendered'] = $customRendered;

        return $obj;
    }

    public function withDateTimeOriginal(string $dateTimeOriginal): self
    {
        $obj = clone $this;
        $obj['dateTimeOriginal'] = $dateTimeOriginal;

        return $obj;
    }

    public function withExifImageHeight(int $exifImageHeight): self
    {
        $obj = clone $this;
        $obj['exifImageHeight'] = $exifImageHeight;

        return $obj;
    }

    public function withExifImageWidth(int $exifImageWidth): self
    {
        $obj = clone $this;
        $obj['exifImageWidth'] = $exifImageWidth;

        return $obj;
    }

    public function withExifVersion(string $exifVersion): self
    {
        $obj = clone $this;
        $obj['exifVersion'] = $exifVersion;

        return $obj;
    }

    public function withExposureCompensation(float $exposureCompensation): self
    {
        $obj = clone $this;
        $obj['exposureCompensation'] = $exposureCompensation;

        return $obj;
    }

    public function withExposureMode(int $exposureMode): self
    {
        $obj = clone $this;
        $obj['exposureMode'] = $exposureMode;

        return $obj;
    }

    public function withExposureProgram(int $exposureProgram): self
    {
        $obj = clone $this;
        $obj['exposureProgram'] = $exposureProgram;

        return $obj;
    }

    public function withExposureTime(float $exposureTime): self
    {
        $obj = clone $this;
        $obj['exposureTime'] = $exposureTime;

        return $obj;
    }

    public function withFlash(int $flash): self
    {
        $obj = clone $this;
        $obj['flash'] = $flash;

        return $obj;
    }

    public function withFlashpixVersion(string $flashpixVersion): self
    {
        $obj = clone $this;
        $obj['flashpixVersion'] = $flashpixVersion;

        return $obj;
    }

    public function withFNumber(float $fNumber): self
    {
        $obj = clone $this;
        $obj['fNumber'] = $fNumber;

        return $obj;
    }

    public function withFocalLength(int $focalLength): self
    {
        $obj = clone $this;
        $obj['focalLength'] = $focalLength;

        return $obj;
    }

    public function withFocalPlaneResolutionUnit(
        int $focalPlaneResolutionUnit
    ): self {
        $obj = clone $this;
        $obj['focalPlaneResolutionUnit'] = $focalPlaneResolutionUnit;

        return $obj;
    }

    public function withFocalPlaneXResolution(
        float $focalPlaneXResolution
    ): self {
        $obj = clone $this;
        $obj['focalPlaneXResolution'] = $focalPlaneXResolution;

        return $obj;
    }

    public function withFocalPlaneYResolution(
        float $focalPlaneYResolution
    ): self {
        $obj = clone $this;
        $obj['focalPlaneYResolution'] = $focalPlaneYResolution;

        return $obj;
    }

    public function withInteropOffset(int $interopOffset): self
    {
        $obj = clone $this;
        $obj['interopOffset'] = $interopOffset;

        return $obj;
    }

    public function withISO(int $iso): self
    {
        $obj = clone $this;
        $obj['iso'] = $iso;

        return $obj;
    }

    public function withMeteringMode(int $meteringMode): self
    {
        $obj = clone $this;
        $obj['meteringMode'] = $meteringMode;

        return $obj;
    }

    public function withSceneCaptureType(int $sceneCaptureType): self
    {
        $obj = clone $this;
        $obj['sceneCaptureType'] = $sceneCaptureType;

        return $obj;
    }

    public function withShutterSpeedValue(float $shutterSpeedValue): self
    {
        $obj = clone $this;
        $obj['shutterSpeedValue'] = $shutterSpeedValue;

        return $obj;
    }

    public function withSubSecTime(string $subSecTime): self
    {
        $obj = clone $this;
        $obj['subSecTime'] = $subSecTime;

        return $obj;
    }

    public function withWhiteBalance(int $whiteBalance): self
    {
        $obj = clone $this;
        $obj['whiteBalance'] = $whiteBalance;

        return $obj;
    }
}
