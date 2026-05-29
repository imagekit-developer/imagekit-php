<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * JSON object containing metadata.
 *
 * @phpstan-type MetadataShape = array{
 *   audioCodec?: string|null,
 *   bitRate?: int|null,
 *   density?: int|null,
 *   duration?: int|null,
 *   format?: string|null,
 *   hasAlpha?: bool|null,
 *   hasColorProfile?: bool|null,
 *   hasTransparency?: bool|null,
 *   height?: int|null,
 *   mime?: string|null,
 *   pHash?: string|null,
 *   quality?: int|null,
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
    #[Optional('audio_codec')]
    public ?string $audioCodec;

    /**
     * The bit rate of the video in kbps (only for video).
     */
    #[Optional('bit_rate')]
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

    /**
     * The format of the file (e.g., 'jpg', 'mp4').
     */
    #[Optional]
    public ?string $format;

    /**
     * Specifies if the image has an alpha channel.
     */
    #[Optional('has_alpha')]
    public ?bool $hasAlpha;

    /**
     * Indicates if the image has a color profile.
     */
    #[Optional('has_color_profile')]
    public ?bool $hasColorProfile;

    /**
     * Indicates if the image contains transparent areas.
     */
    #[Optional('has_transparency')]
    public ?bool $hasTransparency;

    /**
     * The height of the image or video in pixels.
     */
    #[Optional]
    public ?int $height;

    /**
     * MIME type of the file.
     */
    #[Optional]
    public ?string $mime;

    /**
     * Perceptual hash of the image.
     */
    #[Optional('p_hash')]
    public ?string $pHash;

    /**
     * The quality indicator of the image.
     */
    #[Optional]
    public ?int $quality;

    /**
     * The video codec used in the video (only for video).
     */
    #[Optional('video_codec')]
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
     */
    public static function with(
        ?string $audioCodec = null,
        ?int $bitRate = null,
        ?int $density = null,
        ?int $duration = null,
        ?string $format = null,
        ?bool $hasAlpha = null,
        ?bool $hasColorProfile = null,
        ?bool $hasTransparency = null,
        ?int $height = null,
        ?string $mime = null,
        ?string $pHash = null,
        ?int $quality = null,
        ?string $videoCodec = null,
        ?int $width = null,
    ): self {
        $self = new self;

        null !== $audioCodec && $self['audioCodec'] = $audioCodec;
        null !== $bitRate && $self['bitRate'] = $bitRate;
        null !== $density && $self['density'] = $density;
        null !== $duration && $self['duration'] = $duration;
        null !== $format && $self['format'] = $format;
        null !== $hasAlpha && $self['hasAlpha'] = $hasAlpha;
        null !== $hasColorProfile && $self['hasColorProfile'] = $hasColorProfile;
        null !== $hasTransparency && $self['hasTransparency'] = $hasTransparency;
        null !== $height && $self['height'] = $height;
        null !== $mime && $self['mime'] = $mime;
        null !== $pHash && $self['pHash'] = $pHash;
        null !== $quality && $self['quality'] = $quality;
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
     * The format of the file (e.g., 'jpg', 'mp4').
     */
    public function withFormat(string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Specifies if the image has an alpha channel.
     */
    public function withHasAlpha(bool $hasAlpha): self
    {
        $self = clone $this;
        $self['hasAlpha'] = $hasAlpha;

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
     * MIME type of the file.
     */
    public function withMime(string $mime): self
    {
        $self = clone $this;
        $self['mime'] = $mime;

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
