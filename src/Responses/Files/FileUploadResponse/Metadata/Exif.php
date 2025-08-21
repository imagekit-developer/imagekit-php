<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\FileUploadResponse\Metadata;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\MapOf;
use ImageKit\Shared\ExifDetails;
use ImageKit\Shared\ExifImage;
use ImageKit\Shared\Gps;
use ImageKit\Shared\Interoperability;
use ImageKit\Shared\Thumbnail;

/**
 * @phpstan-type exif_alias = array{
 *   exif?: ExifDetails,
 *   gps?: Gps,
 *   image?: ExifImage,
 *   interoperability?: Interoperability,
 *   makernote?: array<string, mixed>,
 *   thumbnail?: Thumbnail,
 * }
 */
final class Exif implements BaseModel
{
    use SdkModel;

    /**
     * Object containing Exif details.
     */
    #[Api(optional: true)]
    public ?ExifDetails $exif;

    /**
     * Object containing GPS information.
     */
    #[Api(optional: true)]
    public ?Gps $gps;

    /**
     * Object containing EXIF image information.
     */
    #[Api(optional: true)]
    public ?ExifImage $image;

    /**
     * JSON object.
     */
    #[Api(optional: true)]
    public ?Interoperability $interoperability;

    /** @var null|array<string, mixed> $makernote */
    #[Api(type: new MapOf('string'), optional: true)]
    public ?array $makernote;

    /**
     * Object containing Thumbnail information.
     */
    #[Api(optional: true)]
    public ?Thumbnail $thumbnail;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|array<string, mixed> $makernote
     */
    public static function with(
        ?ExifDetails $exif = null,
        ?Gps $gps = null,
        ?ExifImage $image = null,
        ?Interoperability $interoperability = null,
        ?array $makernote = null,
        ?Thumbnail $thumbnail = null,
    ): self {
        $obj = new self;

        null !== $exif && $obj->exif = $exif;
        null !== $gps && $obj->gps = $gps;
        null !== $image && $obj->image = $image;
        null !== $interoperability && $obj->interoperability = $interoperability;
        null !== $makernote && $obj->makernote = $makernote;
        null !== $thumbnail && $obj->thumbnail = $thumbnail;

        return $obj;
    }

    /**
     * Object containing Exif details.
     */
    public function withExif(ExifDetails $exif): self
    {
        $obj = clone $this;
        $obj->exif = $exif;

        return $obj;
    }

    /**
     * Object containing GPS information.
     */
    public function withGps(Gps $gps): self
    {
        $obj = clone $this;
        $obj->gps = $gps;

        return $obj;
    }

    /**
     * Object containing EXIF image information.
     */
    public function withImage(ExifImage $image): self
    {
        $obj = clone $this;
        $obj->image = $image;

        return $obj;
    }

    /**
     * JSON object.
     */
    public function withInteroperability(
        Interoperability $interoperability
    ): self {
        $obj = clone $this;
        $obj->interoperability = $interoperability;

        return $obj;
    }

    /**
     * @param array<string, mixed> $makernote
     */
    public function withMakernote(array $makernote): self
    {
        $obj = clone $this;
        $obj->makernote = $makernote;

        return $obj;
    }

    /**
     * Object containing Thumbnail information.
     */
    public function withThumbnail(Thumbnail $thumbnail): self
    {
        $obj = clone $this;
        $obj->thumbnail = $thumbnail;

        return $obj;
    }
}
