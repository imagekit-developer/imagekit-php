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
 * @phpstan-import-type ExifShape from \Imagekit\Files\Metadata\Exif\Exif as ExifShape1
 * @phpstan-import-type GpsShape from \Imagekit\Files\Metadata\Exif\Gps
 * @phpstan-import-type ImageShape from \Imagekit\Files\Metadata\Exif\Image
 * @phpstan-import-type InteroperabilityShape from \Imagekit\Files\Metadata\Exif\Interoperability
 * @phpstan-import-type ThumbnailShape from \Imagekit\Files\Metadata\Exif\Thumbnail
 *
 * @phpstan-type ExifShape = array{
 *   exif?: null|\Imagekit\Files\Metadata\Exif\Exif|ExifShape1,
 *   gps?: null|Gps|GpsShape,
 *   image?: null|Image|ImageShape,
 *   interoperability?: null|Interoperability|InteroperabilityShape,
 *   makernote?: array<string,mixed>|null,
 *   thumbnail?: null|Thumbnail|ThumbnailShape,
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
     * @param ExifShape1 $exif
     * @param GpsShape $gps
     * @param ImageShape $image
     * @param InteroperabilityShape $interoperability
     * @param array<string,mixed> $makernote
     * @param ThumbnailShape $thumbnail
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
     * @param ExifShape1 $exif
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
     * @param GpsShape $gps
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
     * @param ImageShape $image
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
     * @param InteroperabilityShape $interoperability
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
     * @param ThumbnailShape $thumbnail
     */
    public function withThumbnail(Thumbnail|array $thumbnail): self
    {
        $self = clone $this;
        $self['thumbnail'] = $thumbnail;

        return $self;
    }
}
