<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Metadata;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Responses\Files\Metadata\MetadataGetResponse\Exif;

/**
 * JSON object containing metadata.
 *
 * @phpstan-type metadata_get_response_alias = array{
 *   audioCodec?: string,
 *   bitRate?: int,
 *   density?: int,
 *   duration?: int,
 *   exif?: Exif,
 *   format?: string,
 *   hasColorProfile?: bool,
 *   hasTransparency?: bool,
 *   height?: int,
 *   pHash?: string,
 *   quality?: int,
 *   size?: int,
 *   videoCodec?: string,
 *   width?: int,
 * }
 */
final class MetadataGetResponse implements BaseModel
{
    use Model;

    /**
     * The audio codec used in the video (only for video).
     */
    #[Api(optional: true)]
    public ?string $audioCodec;

    /**
     * The bit rate of the video in kbps (only for video).
     */
    #[Api(optional: true)]
    public ?int $bitRate;

    /**
     * The density of the image in DPI.
     */
    #[Api(optional: true)]
    public ?int $density;

    /**
     * The duration of the video in seconds (only for video).
     */
    #[Api(optional: true)]
    public ?int $duration;

    #[Api(optional: true)]
    public ?Exif $exif;

    /**
     * The format of the file (e.g., 'jpg', 'mp4').
     */
    #[Api(optional: true)]
    public ?string $format;

    /**
     * Indicates if the image has a color profile.
     */
    #[Api(optional: true)]
    public ?bool $hasColorProfile;

    /**
     * Indicates if the image contains transparent areas.
     */
    #[Api(optional: true)]
    public ?bool $hasTransparency;

    /**
     * The height of the image or video in pixels.
     */
    #[Api(optional: true)]
    public ?int $height;

    /**
     * Perceptual hash of the image.
     */
    #[Api(optional: true)]
    public ?string $pHash;

    /**
     * The quality indicator of the image.
     */
    #[Api(optional: true)]
    public ?int $quality;

    /**
     * The file size in bytes.
     */
    #[Api(optional: true)]
    public ?int $size;

    /**
     * The video codec used in the video (only for video).
     */
    #[Api(optional: true)]
    public ?string $videoCodec;

    /**
     * The width of the image or video in pixels.
     */
    #[Api(optional: true)]
    public ?int $width;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(
        ?string $audioCodec = null,
        ?int $bitRate = null,
        ?int $density = null,
        ?int $duration = null,
        ?Exif $exif = null,
        ?string $format = null,
        ?bool $hasColorProfile = null,
        ?bool $hasTransparency = null,
        ?int $height = null,
        ?string $pHash = null,
        ?int $quality = null,
        ?int $size = null,
        ?string $videoCodec = null,
        ?int $width = null,
    ): self {
        $obj = new self;

        null !== $audioCodec && $obj->audioCodec = $audioCodec;
        null !== $bitRate && $obj->bitRate = $bitRate;
        null !== $density && $obj->density = $density;
        null !== $duration && $obj->duration = $duration;
        null !== $exif && $obj->exif = $exif;
        null !== $format && $obj->format = $format;
        null !== $hasColorProfile && $obj->hasColorProfile = $hasColorProfile;
        null !== $hasTransparency && $obj->hasTransparency = $hasTransparency;
        null !== $height && $obj->height = $height;
        null !== $pHash && $obj->pHash = $pHash;
        null !== $quality && $obj->quality = $quality;
        null !== $size && $obj->size = $size;
        null !== $videoCodec && $obj->videoCodec = $videoCodec;
        null !== $width && $obj->width = $width;

        return $obj;
    }

    /**
     * The audio codec used in the video (only for video).
     */
    public function setAudioCodec(string $audioCodec): self
    {
        $this->audioCodec = $audioCodec;

        return $this;
    }

    /**
     * The bit rate of the video in kbps (only for video).
     */
    public function setBitRate(int $bitRate): self
    {
        $this->bitRate = $bitRate;

        return $this;
    }

    /**
     * The density of the image in DPI.
     */
    public function setDensity(int $density): self
    {
        $this->density = $density;

        return $this;
    }

    /**
     * The duration of the video in seconds (only for video).
     */
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function setExif(Exif $exif): self
    {
        $this->exif = $exif;

        return $this;
    }

    /**
     * The format of the file (e.g., 'jpg', 'mp4').
     */
    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Indicates if the image has a color profile.
     */
    public function setHasColorProfile(bool $hasColorProfile): self
    {
        $this->hasColorProfile = $hasColorProfile;

        return $this;
    }

    /**
     * Indicates if the image contains transparent areas.
     */
    public function setHasTransparency(bool $hasTransparency): self
    {
        $this->hasTransparency = $hasTransparency;

        return $this;
    }

    /**
     * The height of the image or video in pixels.
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Perceptual hash of the image.
     */
    public function setPHash(string $pHash): self
    {
        $this->pHash = $pHash;

        return $this;
    }

    /**
     * The quality indicator of the image.
     */
    public function setQuality(int $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * The file size in bytes.
     */
    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * The video codec used in the video (only for video).
     */
    public function setVideoCodec(string $videoCodec): self
    {
        $this->videoCodec = $videoCodec;

        return $this;
    }

    /**
     * The width of the image or video in pixels.
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }
}
