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
        $self = new self;

        null !== $apertureValue && $self['apertureValue'] = $apertureValue;
        null !== $colorSpace && $self['colorSpace'] = $colorSpace;
        null !== $createDate && $self['createDate'] = $createDate;
        null !== $customRendered && $self['customRendered'] = $customRendered;
        null !== $dateTimeOriginal && $self['dateTimeOriginal'] = $dateTimeOriginal;
        null !== $exifImageHeight && $self['exifImageHeight'] = $exifImageHeight;
        null !== $exifImageWidth && $self['exifImageWidth'] = $exifImageWidth;
        null !== $exifVersion && $self['exifVersion'] = $exifVersion;
        null !== $exposureCompensation && $self['exposureCompensation'] = $exposureCompensation;
        null !== $exposureMode && $self['exposureMode'] = $exposureMode;
        null !== $exposureProgram && $self['exposureProgram'] = $exposureProgram;
        null !== $exposureTime && $self['exposureTime'] = $exposureTime;
        null !== $flash && $self['flash'] = $flash;
        null !== $flashpixVersion && $self['flashpixVersion'] = $flashpixVersion;
        null !== $fNumber && $self['fNumber'] = $fNumber;
        null !== $focalLength && $self['focalLength'] = $focalLength;
        null !== $focalPlaneResolutionUnit && $self['focalPlaneResolutionUnit'] = $focalPlaneResolutionUnit;
        null !== $focalPlaneXResolution && $self['focalPlaneXResolution'] = $focalPlaneXResolution;
        null !== $focalPlaneYResolution && $self['focalPlaneYResolution'] = $focalPlaneYResolution;
        null !== $interopOffset && $self['interopOffset'] = $interopOffset;
        null !== $iso && $self['iso'] = $iso;
        null !== $meteringMode && $self['meteringMode'] = $meteringMode;
        null !== $sceneCaptureType && $self['sceneCaptureType'] = $sceneCaptureType;
        null !== $shutterSpeedValue && $self['shutterSpeedValue'] = $shutterSpeedValue;
        null !== $subSecTime && $self['subSecTime'] = $subSecTime;
        null !== $whiteBalance && $self['whiteBalance'] = $whiteBalance;

        return $self;
    }

    public function withApertureValue(float $apertureValue): self
    {
        $self = clone $this;
        $self['apertureValue'] = $apertureValue;

        return $self;
    }

    public function withColorSpace(int $colorSpace): self
    {
        $self = clone $this;
        $self['colorSpace'] = $colorSpace;

        return $self;
    }

    public function withCreateDate(string $createDate): self
    {
        $self = clone $this;
        $self['createDate'] = $createDate;

        return $self;
    }

    public function withCustomRendered(int $customRendered): self
    {
        $self = clone $this;
        $self['customRendered'] = $customRendered;

        return $self;
    }

    public function withDateTimeOriginal(string $dateTimeOriginal): self
    {
        $self = clone $this;
        $self['dateTimeOriginal'] = $dateTimeOriginal;

        return $self;
    }

    public function withExifImageHeight(int $exifImageHeight): self
    {
        $self = clone $this;
        $self['exifImageHeight'] = $exifImageHeight;

        return $self;
    }

    public function withExifImageWidth(int $exifImageWidth): self
    {
        $self = clone $this;
        $self['exifImageWidth'] = $exifImageWidth;

        return $self;
    }

    public function withExifVersion(string $exifVersion): self
    {
        $self = clone $this;
        $self['exifVersion'] = $exifVersion;

        return $self;
    }

    public function withExposureCompensation(float $exposureCompensation): self
    {
        $self = clone $this;
        $self['exposureCompensation'] = $exposureCompensation;

        return $self;
    }

    public function withExposureMode(int $exposureMode): self
    {
        $self = clone $this;
        $self['exposureMode'] = $exposureMode;

        return $self;
    }

    public function withExposureProgram(int $exposureProgram): self
    {
        $self = clone $this;
        $self['exposureProgram'] = $exposureProgram;

        return $self;
    }

    public function withExposureTime(float $exposureTime): self
    {
        $self = clone $this;
        $self['exposureTime'] = $exposureTime;

        return $self;
    }

    public function withFlash(int $flash): self
    {
        $self = clone $this;
        $self['flash'] = $flash;

        return $self;
    }

    public function withFlashpixVersion(string $flashpixVersion): self
    {
        $self = clone $this;
        $self['flashpixVersion'] = $flashpixVersion;

        return $self;
    }

    public function withFNumber(float $fNumber): self
    {
        $self = clone $this;
        $self['fNumber'] = $fNumber;

        return $self;
    }

    public function withFocalLength(int $focalLength): self
    {
        $self = clone $this;
        $self['focalLength'] = $focalLength;

        return $self;
    }

    public function withFocalPlaneResolutionUnit(
        int $focalPlaneResolutionUnit
    ): self {
        $self = clone $this;
        $self['focalPlaneResolutionUnit'] = $focalPlaneResolutionUnit;

        return $self;
    }

    public function withFocalPlaneXResolution(
        float $focalPlaneXResolution
    ): self {
        $self = clone $this;
        $self['focalPlaneXResolution'] = $focalPlaneXResolution;

        return $self;
    }

    public function withFocalPlaneYResolution(
        float $focalPlaneYResolution
    ): self {
        $self = clone $this;
        $self['focalPlaneYResolution'] = $focalPlaneYResolution;

        return $self;
    }

    public function withInteropOffset(int $interopOffset): self
    {
        $self = clone $this;
        $self['interopOffset'] = $interopOffset;

        return $self;
    }

    public function withISO(int $iso): self
    {
        $self = clone $this;
        $self['iso'] = $iso;

        return $self;
    }

    public function withMeteringMode(int $meteringMode): self
    {
        $self = clone $this;
        $self['meteringMode'] = $meteringMode;

        return $self;
    }

    public function withSceneCaptureType(int $sceneCaptureType): self
    {
        $self = clone $this;
        $self['sceneCaptureType'] = $sceneCaptureType;

        return $self;
    }

    public function withShutterSpeedValue(float $shutterSpeedValue): self
    {
        $self = clone $this;
        $self['shutterSpeedValue'] = $shutterSpeedValue;

        return $self;
    }

    public function withSubSecTime(string $subSecTime): self
    {
        $self = clone $this;
        $self['subSecTime'] = $subSecTime;

        return $self;
    }

    public function withWhiteBalance(int $whiteBalance): self
    {
        $self = clone $this;
        $self['whiteBalance'] = $whiteBalance;

        return $self;
    }
}
