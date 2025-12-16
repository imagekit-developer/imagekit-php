<?php

declare(strict_types=1);

namespace Imagekit\Files;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Files\Metadata\Exif;

/**
 * JSON object containing metadata.
 *
 * @phpstan-import-type ExifShape from \Imagekit\Files\Metadata\Exif
 *
 * @phpstan-type MetadataShape = array{
 *   audioCodec?: string|null,
 *   bitRate?: int|null,
 *   density?: int|null,
 *   duration?: int|null,
 *   exif?: null|Exif|ExifShape,
 *   format?: string|null,
 *   hasColorProfile?: bool|null,
 *   hasTransparency?: bool|null,
 *   height?: int|null,
 *   pHash?: string|null,
 *   quality?: int|null,
 *   size?: int|null,
 *   videoCodec?: string|null,
 *   width?: int|null,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    /**
     * The audio codec used in the video (only for video).
     */
    #[Optional]
    public ?string $audioCodec;

    /**
     * The bit rate of the video in kbps (only for video).
     */
    #[Optional]
    public ?int $bitRate;

    /**
     * The density of the image in DPI.
     */
    #[Optional]
    public ?int $density;

    /**
     * The duration of the video in seconds (only for video).
     */
    #[Optional]
    public ?int $duration;

    #[Optional]
    public ?Exif $exif;

    /**
     * The format of the file (e.g., 'jpg', 'mp4').
     */
    #[Optional]
    public ?string $format;

    /**
     * Indicates if the image has a color profile.
     */
    #[Optional]
    public ?bool $hasColorProfile;

    /**
     * Indicates if the image contains transparent areas.
     */
    #[Optional]
    public ?bool $hasTransparency;

    /**
     * The height of the image or video in pixels.
     */
    #[Optional]
    public ?int $height;

    /**
     * Perceptual hash of the image.
     */
    #[Optional]
    public ?string $pHash;

    /**
     * The quality indicator of the image.
     */
    #[Optional]
    public ?int $quality;

    /**
     * The file size in bytes.
     */
    #[Optional]
    public ?int $size;

    /**
     * The video codec used in the video (only for video).
     */
    #[Optional]
    public ?string $videoCodec;

    /**
     * The width of the image or video in pixels.
     */
    #[Optional]
    public ?int $width;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ExifShape $exif
     */
    public static function with(
        ?string $audioCodec = null,
        ?int $bitRate = null,
        ?int $density = null,
        ?int $duration = null,
        Exif|array|null $exif = null,
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
        $self = new self;

        null !== $audioCodec && $self['audioCodec'] = $audioCodec;
        null !== $bitRate && $self['bitRate'] = $bitRate;
        null !== $density && $self['density'] = $density;
        null !== $duration && $self['duration'] = $duration;
        null !== $exif && $self['exif'] = $exif;
        null !== $format && $self['format'] = $format;
        null !== $hasColorProfile && $self['hasColorProfile'] = $hasColorProfile;
        null !== $hasTransparency && $self['hasTransparency'] = $hasTransparency;
        null !== $height && $self['height'] = $height;
        null !== $pHash && $self['pHash'] = $pHash;
        null !== $quality && $self['quality'] = $quality;
        null !== $size && $self['size'] = $size;
        null !== $videoCodec && $self['videoCodec'] = $videoCodec;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * The audio codec used in the video (only for video).
     */
    public function withAudioCodec(string $audioCodec): self
    {
        $self = clone $this;
        $self['audioCodec'] = $audioCodec;

        return $self;
    }

    /**
     * The bit rate of the video in kbps (only for video).
     */
    public function withBitRate(int $bitRate): self
    {
        $self = clone $this;
        $self['bitRate'] = $bitRate;

        return $self;
    }

    /**
     * The density of the image in DPI.
     */
    public function withDensity(int $density): self
    {
        $self = clone $this;
        $self['density'] = $density;

        return $self;
    }

    /**
     * The duration of the video in seconds (only for video).
     */
    public function withDuration(int $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * @param ExifShape $exif
     */
    public function withExif(Exif|array $exif): self
    {
        $self = clone $this;
        $self['exif'] = $exif;

        return $self;
    }

    /**
     * The format of the file (e.g., 'jpg', 'mp4').
     */
    public function withFormat(string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Indicates if the image has a color profile.
     */
    public function withHasColorProfile(bool $hasColorProfile): self
    {
        $self = clone $this;
        $self['hasColorProfile'] = $hasColorProfile;

        return $self;
    }

    /**
     * Indicates if the image contains transparent areas.
     */
    public function withHasTransparency(bool $hasTransparency): self
    {
        $self = clone $this;
        $self['hasTransparency'] = $hasTransparency;

        return $self;
    }

    /**
     * The height of the image or video in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Perceptual hash of the image.
     */
    public function withPHash(string $pHash): self
    {
        $self = clone $this;
        $self['pHash'] = $pHash;

        return $self;
    }

    /**
     * The quality indicator of the image.
     */
    public function withQuality(int $quality): self
    {
        $self = clone $this;
        $self['quality'] = $quality;

        return $self;
    }

    /**
     * The file size in bytes.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * The video codec used in the video (only for video).
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $self = clone $this;
        $self['videoCodec'] = $videoCodec;

        return $self;
    }

    /**
     * The width of the image or video in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
