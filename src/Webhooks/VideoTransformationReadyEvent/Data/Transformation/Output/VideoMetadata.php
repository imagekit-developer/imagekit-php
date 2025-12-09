<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Output;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Metadata of the output video file.
 *
 * @phpstan-type VideoMetadataShape = array{
 *   bitrate: int, duration: float, height: int, width: int
 * }
 */
final class VideoMetadata implements BaseModel
{
    /** @use SdkModel<VideoMetadataShape> */
    use SdkModel;

    /**
     * Bitrate of the output video in bits per second.
     */
    #[Required]
    public int $bitrate;

    /**
     * Duration of the output video in seconds.
     */
    #[Required]
    public float $duration;

    /**
     * Height of the output video in pixels.
     */
    #[Required]
    public int $height;

    /**
     * Width of the output video in pixels.
     */
    #[Required]
    public int $width;

    /**
     * `new VideoMetadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoMetadata::with(bitrate: ..., duration: ..., height: ..., width: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoMetadata)
     *   ->withBitrate(...)
     *   ->withDuration(...)
     *   ->withHeight(...)
     *   ->withWidth(...)
     * ```
     */
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
        int $bitrate,
        float $duration,
        int $height,
        int $width
    ): self {
        $self = new self;

        $self['bitrate'] = $bitrate;
        $self['duration'] = $duration;
        $self['height'] = $height;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Bitrate of the output video in bits per second.
     */
    public function withBitrate(int $bitrate): self
    {
        $self = clone $this;
        $self['bitrate'] = $bitrate;

        return $self;
    }

    /**
     * Duration of the output video in seconds.
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Height of the output video in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Width of the output video in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
