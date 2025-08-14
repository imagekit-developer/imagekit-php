<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\FileUploadV1Response;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Responses\Files\FileUploadV1Response\Metadata\Exif;

/**
 * Legacy metadata. Send `metadata` in `responseFields` in API request to get metadata in the upload API response.
 *
 * @phpstan-type metadata_alias = array{
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
final class Metadata implements BaseModel
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
    public static function with(
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
    public function withAudioCodec(string $audioCodec): self
    {
        $obj = clone $this;
        $obj->audioCodec = $audioCodec;

        return $obj;
    }

    /**
     * The bit rate of the video in kbps (only for video).
     */
    public function withBitRate(int $bitRate): self
    {
        $obj = clone $this;
        $obj->bitRate = $bitRate;

        return $obj;
    }

    /**
     * The density of the image in DPI.
     */
    public function withDensity(int $density): self
    {
        $obj = clone $this;
        $obj->density = $density;

        return $obj;
    }

    /**
     * The duration of the video in seconds (only for video).
     */
    public function withDuration(int $duration): self
    {
        $obj = clone $this;
        $obj->duration = $duration;

        return $obj;
    }

    public function withExif(Exif $exif): self
    {
        $obj = clone $this;
        $obj->exif = $exif;

        return $obj;
    }

    /**
     * The format of the file (e.g., 'jpg', 'mp4').
     */
    public function withFormat(string $format): self
    {
        $obj = clone $this;
        $obj->format = $format;

        return $obj;
    }

    /**
     * Indicates if the image has a color profile.
     */
    public function withHasColorProfile(bool $hasColorProfile): self
    {
        $obj = clone $this;
        $obj->hasColorProfile = $hasColorProfile;

        return $obj;
    }

    /**
     * Indicates if the image contains transparent areas.
     */
    public function withHasTransparency(bool $hasTransparency): self
    {
        $obj = clone $this;
        $obj->hasTransparency = $hasTransparency;

        return $obj;
    }

    /**
     * The height of the image or video in pixels.
     */
    public function withHeight(int $height): self
    {
        $obj = clone $this;
        $obj->height = $height;

        return $obj;
    }

    /**
     * Perceptual hash of the image.
     */
    public function withPHash(string $pHash): self
    {
        $obj = clone $this;
        $obj->pHash = $pHash;

        return $obj;
    }

    /**
     * The quality indicator of the image.
     */
    public function withQuality(int $quality): self
    {
        $obj = clone $this;
        $obj->quality = $quality;

        return $obj;
    }

    /**
     * The file size in bytes.
     */
    public function withSize(int $size): self
    {
        $obj = clone $this;
        $obj->size = $size;

        return $obj;
    }

    /**
     * The video codec used in the video (only for video).
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $obj = clone $this;
        $obj->videoCodec = $videoCodec;

        return $obj;
    }

    /**
     * The width of the image or video in pixels.
     */
    public function withWidth(int $width): self
    {
        $obj = clone $this;
        $obj->width = $width;

        return $obj;
    }
}
