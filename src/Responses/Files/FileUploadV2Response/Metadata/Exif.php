<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\FileUploadV2Response\Metadata;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\MapOf;
use ImageKit\Responses\Files\FileUploadV2Response\Metadata\Exif\Exif as Exif1;
use ImageKit\Responses\Files\FileUploadV2Response\Metadata\Exif\Gps;
use ImageKit\Responses\Files\FileUploadV2Response\Metadata\Exif\Image;
use ImageKit\Responses\Files\FileUploadV2Response\Metadata\Exif\Interoperability;
use ImageKit\Responses\Files\FileUploadV2Response\Metadata\Exif\Thumbnail;

/**
 * @phpstan-type exif_alias = array{
 *   exif?: Exif1,
 *   gps?: Gps,
 *   image?: Image,
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
    public ?Exif1 $exif;

    /**
     * Object containing GPS information.
     */
    #[Api(optional: true)]
    public ?Gps $gps;

    /**
     * Object containing EXIF image information.
     */
    #[Api(optional: true)]
    public ?Image $image;

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
    public static function new(
        ?Exif1 $exif = null,
        ?Gps $gps = null,
        ?Image $image = null,
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
    public function setExif(Exif1 $exif): self
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
    public function setImage(Image $image): self
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
