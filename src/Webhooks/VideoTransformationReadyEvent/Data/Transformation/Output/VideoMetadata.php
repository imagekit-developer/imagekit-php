<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Output;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type video_metadata = array{
 *   bitrate: int, duration: float, height: int, width: int
 * }
 */
final class VideoMetadata implements BaseModel
{
    /** @use SdkModel<video_metadata> */
    use SdkModel;

    #[Api]
    public int $bitrate;

    #[Api]
    public float $duration;

    #[Api]
    public int $height;

    #[Api]
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
        $obj = new self;

        $obj->bitrate = $bitrate;
        $obj->duration = $duration;
        $obj->height = $height;
        $obj->width = $width;

        return $obj;
    }

    public function withBitrate(int $bitrate): self
    {
        $obj = clone $this;
        $obj->bitrate = $bitrate;

        return $obj;
    }

    public function withDuration(float $duration): self
    {
        $obj = clone $this;
        $obj->duration = $duration;

        return $obj;
    }

    public function withHeight(int $height): self
    {
        $obj = clone $this;
        $obj->height = $height;

        return $obj;
    }

    public function withWidth(int $width): self
    {
        $obj = clone $this;
        $obj->width = $width;

        return $obj;
    }
}
