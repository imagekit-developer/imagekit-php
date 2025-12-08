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
     * } $exif
     * @param Gps|array{GPSVersionID?: list<int>|null} $gps
     * @param Image|array{
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
     * } $image
     * @param Interoperability|array{
     *   InteropIndex?: string|null, InteropVersion?: string|null
     * } $interoperability
     * @param array<string,mixed> $makernote
     * @param Thumbnail|array{
     *   Compression?: int|null,
     *   ResolutionUnit?: int|null,
     *   ThumbnailLength?: int|null,
     *   ThumbnailOffset?: int|null,
     *   XResolution?: int|null,
     *   YResolution?: int|null,
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
        $obj = new self;

        null !== $exif && $obj['exif'] = $exif;
        null !== $gps && $obj['gps'] = $gps;
        null !== $image && $obj['image'] = $image;
        null !== $interoperability && $obj['interoperability'] = $interoperability;
        null !== $makernote && $obj['makernote'] = $makernote;
        null !== $thumbnail && $obj['thumbnail'] = $thumbnail;

        return $obj;
    }

    /**
     * Object containing Exif details.
     *
     * @param Exif\Exif|array{
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
     * } $exif
     */
    public function withExif(
        Exif\Exif|array $exif
    ): self {
        $obj = clone $this;
        $obj['exif'] = $exif;

        return $obj;
    }

    /**
     * Object containing GPS information.
     *
     * @param Gps|array{GPSVersionID?: list<int>|null} $gps
     */
    public function withGps(Gps|array $gps): self
    {
        $obj = clone $this;
        $obj['gps'] = $gps;

        return $obj;
    }

    /**
     * Object containing EXIF image information.
     *
     * @param Image|array{
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
     * } $image
     */
    public function withImage(Image|array $image): self
    {
        $obj = clone $this;
        $obj['image'] = $image;

        return $obj;
    }

    /**
     * JSON object.
     *
     * @param Interoperability|array{
     *   InteropIndex?: string|null, InteropVersion?: string|null
     * } $interoperability
     */
    public function withInteroperability(
        Interoperability|array $interoperability
    ): self {
        $obj = clone $this;
        $obj['interoperability'] = $interoperability;

        return $obj;
    }

    /**
     * @param array<string,mixed> $makernote
     */
    public function withMakernote(array $makernote): self
    {
        $obj = clone $this;
        $obj['makernote'] = $makernote;

        return $obj;
    }

    /**
     * Object containing Thumbnail information.
     *
     * @param Thumbnail|array{
     *   Compression?: int|null,
     *   ResolutionUnit?: int|null,
     *   ThumbnailLength?: int|null,
     *   ThumbnailOffset?: int|null,
     *   XResolution?: int|null,
     *   YResolution?: int|null,
     * } $thumbnail
     */
    public function withThumbnail(Thumbnail|array $thumbnail): self
    {
        $obj = clone $this;
        $obj['thumbnail'] = $thumbnail;

        return $obj;
    }
}
