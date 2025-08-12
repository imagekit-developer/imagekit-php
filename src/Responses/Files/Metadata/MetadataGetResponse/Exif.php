<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Metadata\MetadataGetResponse;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\MapOf;
use ImageKit\Files\ExifDetails;
use ImageKit\Files\ExifImage;
use ImageKit\Files\Gps;
use ImageKit\Files\Interoperability;
use ImageKit\Files\Thumbnail;

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
    use Model;

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
    public static function from(
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
    public function setExif(ExifDetails $exif): self
    {
        $this->exif = $exif;

        return $this;
    }

    /**
     * Object containing GPS information.
     */
    public function setGps(Gps $gps): self
    {
        $this->gps = $gps;

        return $this;
    }

    /**
     * Object containing EXIF image information.
     */
    public function setImage(ExifImage $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * JSON object.
     */
    public function setInteroperability(
        Interoperability $interoperability
    ): self {
        $this->interoperability = $interoperability;

        return $this;
    }

    /**
     * @param array<string, mixed> $makernote
     */
    public function setMakernote(array $makernote): self
    {
        $this->makernote = $makernote;

        return $this;
    }

    /**
     * Object containing Thumbnail information.
     */
    public function setThumbnail(Thumbnail $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
}
