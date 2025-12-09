<?php

declare(strict_types=1);

namespace Imagekit\Files\Metadata;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Files\Metadata\Exif\Gps;
use Imagekit\Files\Metadata\Exif\Image;
use Imagekit\Files\Metadata\Exif\Interoperability;
use Imagekit\Files\Metadata\Exif\Thumbnail;

/**
 * @phpstan-type ExifShape = array{
 *   exif?: \Imagekit\Files\Metadata\Exif\Exif|null,
 *   gps?: Gps|null,
 *   image?: Image|null,
 *   interoperability?: Interoperability|null,
 *   makernote?: array<string,mixed>|null,
 *   thumbnail?: Thumbnail|null,
 * }
 */
final class Exif implements BaseModel
{
    /** @use SdkModel<ExifShape> */
    use SdkModel;

    /**
     * Object containing Exif details.
     */
    #[Optional]
    public ?Exif\Exif $exif;

    /**
     * Object containing GPS information.
     */
    #[Optional]
    public ?Gps $gps;

    /**
     * Object containing EXIF image information.
     */
    #[Optional]
    public ?Image $image;

    /**
     * JSON object.
     */
    #[Optional]
    public ?Interoperability $interoperability;

    /** @var array<string,mixed>|null $makernote */
    #[Optional(map: 'mixed')]
    public ?array $makernote;

    /**
     * Object containing Thumbnail information.
     */
    #[Optional]
    public ?Thumbnail $thumbnail;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Exif\Exif|array{
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
     * } $exif
     * @param Gps|array{gpsVersionID?: list<int>|null} $gps
     * @param Image|array{
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
     * } $image
     * @param Interoperability|array{
     *   interopIndex?: string|null, interopVersion?: string|null
     * } $interoperability
     * @param array<string,mixed> $makernote
     * @param Thumbnail|array{
     *   compression?: int|null,
     *   resolutionUnit?: int|null,
     *   thumbnailLength?: int|null,
     *   thumbnailOffset?: int|null,
     *   xResolution?: int|null,
     *   yResolution?: int|null,
     * } $thumbnail
     */
    public static function with(
        Exif\Exif|array|null $exif = null,
        Gps|array|null $gps = null,
        Image|array|null $image = null,
        Interoperability|array|null $interoperability = null,
        ?array $makernote = null,
        Thumbnail|array|null $thumbnail = null,
    ): self {
        $self = new self;

        null !== $exif && $self['exif'] = $exif;
        null !== $gps && $self['gps'] = $gps;
        null !== $image && $self['image'] = $image;
        null !== $interoperability && $self['interoperability'] = $interoperability;
        null !== $makernote && $self['makernote'] = $makernote;
        null !== $thumbnail && $self['thumbnail'] = $thumbnail;

        return $self;
    }

    /**
     * Object containing Exif details.
     *
     * @param Exif\Exif|array{
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
     * } $exif
     */
    public function withExif(
        Exif\Exif|array $exif
    ): self {
        $self = clone $this;
        $self['exif'] = $exif;

        return $self;
    }

    /**
     * Object containing GPS information.
     *
     * @param Gps|array{gpsVersionID?: list<int>|null} $gps
     */
    public function withGps(Gps|array $gps): self
    {
        $self = clone $this;
        $self['gps'] = $gps;

        return $self;
    }

    /**
     * Object containing EXIF image information.
     *
     * @param Image|array{
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
     * } $image
     */
    public function withImage(Image|array $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }

    /**
     * JSON object.
     *
     * @param Interoperability|array{
     *   interopIndex?: string|null, interopVersion?: string|null
     * } $interoperability
     */
    public function withInteroperability(
        Interoperability|array $interoperability
    ): self {
        $self = clone $this;
        $self['interoperability'] = $interoperability;

        return $self;
    }

    /**
     * @param array<string,mixed> $makernote
     */
    public function withMakernote(array $makernote): self
    {
        $self = clone $this;
        $self['makernote'] = $makernote;

        return $self;
    }

    /**
     * Object containing Thumbnail information.
     *
     * @param Thumbnail|array{
     *   compression?: int|null,
     *   resolutionUnit?: int|null,
     *   thumbnailLength?: int|null,
     *   thumbnailOffset?: int|null,
     *   xResolution?: int|null,
     *   yResolution?: int|null,
     * } $thumbnail
     */
    public function withThumbnail(Thumbnail|array $thumbnail): self
    {
        $self = clone $this;
        $self['thumbnail'] = $thumbnail;

        return $self;
    }
}
