<?php

declare(strict_types=1);

namespace ImageKit\Files\Metadata\Exif;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Object containing Exif details.
 *
 * @phpstan-type ExifShape = array{
 *   apertureValue?: float|null,
 *   brightnessValue?: float|null,
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
 *   focalLength?: float|null,
 *   focalLengthIn35mmFormat?: int|null,
 *   focalPlaneResolutionUnit?: int|null,
 *   focalPlaneXResolution?: float|null,
 *   focalPlaneYResolution?: float|null,
 *   interopOffset?: int|null,
 *   iso?: int|null,
 *   lensModel?: string|null,
 *   lightSource?: int|null,
 *   maxApertureValue?: float|null,
 *   meteringMode?: int|null,
 *   sceneCaptureType?: int|null,
 *   sceneType?: string|null,
 *   sensingMethod?: int|null,
 *   shutterSpeedValue?: float|null,
 *   subSecTime?: string|null,
 *   userComment?: string|null,
 *   whiteBalance?: int|null,
 * }
 */
final class Exif implements BaseModel
{
    /** @use SdkModel<ExifShape> */
    use SdkModel;

    #[Optional('ApertureValue')]
    public ?float $apertureValue;

    #[Optional('BrightnessValue')]
    public ?float $brightnessValue;

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
    public ?float $focalLength;

    #[Optional('FocalLengthIn35mmFormat')]
    public ?int $focalLengthIn35mmFormat;

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

    #[Optional('LensModel')]
    public ?string $lensModel;

    #[Optional('LightSource')]
    public ?int $lightSource;

    #[Optional('MaxApertureValue')]
    public ?float $maxApertureValue;

    #[Optional('MeteringMode')]
    public ?int $meteringMode;

    #[Optional('SceneCaptureType')]
    public ?int $sceneCaptureType;

    #[Optional('SceneType')]
    public ?string $sceneType;

    #[Optional('SensingMethod')]
    public ?int $sensingMethod;

    #[Optional('ShutterSpeedValue')]
    public ?float $shutterSpeedValue;

    #[Optional('SubSecTime')]
    public ?string $subSecTime;

    #[Optional('UserComment')]
    public ?string $userComment;

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
        ?float $brightnessValue = null,
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
        ?float $focalLength = null,
        ?int $focalLengthIn35mmFormat = null,
        ?int $focalPlaneResolutionUnit = null,
        ?float $focalPlaneXResolution = null,
        ?float $focalPlaneYResolution = null,
        ?int $interopOffset = null,
        ?int $iso = null,
        ?string $lensModel = null,
        ?int $lightSource = null,
        ?float $maxApertureValue = null,
        ?int $meteringMode = null,
        ?int $sceneCaptureType = null,
        ?string $sceneType = null,
        ?int $sensingMethod = null,
        ?float $shutterSpeedValue = null,
        ?string $subSecTime = null,
        ?string $userComment = null,
        ?int $whiteBalance = null,
    ): self {
        $self = new self;

        null !== $apertureValue && $self['apertureValue'] = $apertureValue;
        null !== $brightnessValue && $self['brightnessValue'] = $brightnessValue;
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
        null !== $focalLengthIn35mmFormat && $self['focalLengthIn35mmFormat'] = $focalLengthIn35mmFormat;
        null !== $focalPlaneResolutionUnit && $self['focalPlaneResolutionUnit'] = $focalPlaneResolutionUnit;
        null !== $focalPlaneXResolution && $self['focalPlaneXResolution'] = $focalPlaneXResolution;
        null !== $focalPlaneYResolution && $self['focalPlaneYResolution'] = $focalPlaneYResolution;
        null !== $interopOffset && $self['interopOffset'] = $interopOffset;
        null !== $iso && $self['iso'] = $iso;
        null !== $lensModel && $self['lensModel'] = $lensModel;
        null !== $lightSource && $self['lightSource'] = $lightSource;
        null !== $maxApertureValue && $self['maxApertureValue'] = $maxApertureValue;
        null !== $meteringMode && $self['meteringMode'] = $meteringMode;
        null !== $sceneCaptureType && $self['sceneCaptureType'] = $sceneCaptureType;
        null !== $sceneType && $self['sceneType'] = $sceneType;
        null !== $sensingMethod && $self['sensingMethod'] = $sensingMethod;
        null !== $shutterSpeedValue && $self['shutterSpeedValue'] = $shutterSpeedValue;
        null !== $subSecTime && $self['subSecTime'] = $subSecTime;
        null !== $userComment && $self['userComment'] = $userComment;
        null !== $whiteBalance && $self['whiteBalance'] = $whiteBalance;

        return $self;
    }

    public function withApertureValue(float $apertureValue): self
    {
        $self = clone $this;
        $self['apertureValue'] = $apertureValue;

        return $self;
    }

    public function withBrightnessValue(float $brightnessValue): self
    {
        $self = clone $this;
        $self['brightnessValue'] = $brightnessValue;

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

    public function withFocalLength(float $focalLength): self
    {
        $self = clone $this;
        $self['focalLength'] = $focalLength;

        return $self;
    }

    public function withFocalLengthIn35mmFormat(
        int $focalLengthIn35mmFormat
    ): self {
        $self = clone $this;
        $self['focalLengthIn35mmFormat'] = $focalLengthIn35mmFormat;

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

    public function withLensModel(string $lensModel): self
    {
        $self = clone $this;
        $self['lensModel'] = $lensModel;

        return $self;
    }

    public function withLightSource(int $lightSource): self
    {
        $self = clone $this;
        $self['lightSource'] = $lightSource;

        return $self;
    }

    public function withMaxApertureValue(float $maxApertureValue): self
    {
        $self = clone $this;
        $self['maxApertureValue'] = $maxApertureValue;

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

    public function withSceneType(string $sceneType): self
    {
        $self = clone $this;
        $self['sceneType'] = $sceneType;

        return $self;
    }

    public function withSensingMethod(int $sensingMethod): self
    {
        $self = clone $this;
        $self['sensingMethod'] = $sensingMethod;

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

    public function withUserComment(string $userComment): self
    {
        $self = clone $this;
        $self['userComment'] = $userComment;

        return $self;
    }

    public function withWhiteBalance(int $whiteBalance): self
    {
        $self = clone $this;
        $self['whiteBalance'] = $whiteBalance;

        return $self;
    }
}
