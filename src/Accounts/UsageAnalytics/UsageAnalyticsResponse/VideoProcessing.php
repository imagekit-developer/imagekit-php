<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type VideoProcessingShape = array{
 *   codec: string, durationSeconds: float, resolution: string
 * }
 */
final class VideoProcessing implements BaseModel
{
    /** @use SdkModel<VideoProcessingShape> */
    use SdkModel;

    /**
     * Video codec used for the output (e.g. `h264`, `av1`).
     */
    #[Required]
    public string $codec;

    /**
     * Total output duration, in seconds, for this resolution and codec combination.
     */
    #[Required]
    public float $durationSeconds;

    /**
     * Output resolution tier (e.g. `SD`, `HD`, `4K`).
     */
    #[Required]
    public string $resolution;

    /**
     * `new VideoProcessing()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoProcessing::with(codec: ..., durationSeconds: ..., resolution: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoProcessing)
     *   ->withCodec(...)
     *   ->withDurationSeconds(...)
     *   ->withResolution(...)
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
        string $codec,
        float $durationSeconds,
        string $resolution
    ): self {
        $self = new self;

        $self['codec'] = $codec;
        $self['durationSeconds'] = $durationSeconds;
        $self['resolution'] = $resolution;

        return $self;
    }

    /**
     * Video codec used for the output (e.g. `h264`, `av1`).
     */
    public function withCodec(string $codec): self
    {
        $self = clone $this;
        $self['codec'] = $codec;

        return $self;
    }

    /**
     * Total output duration, in seconds, for this resolution and codec combination.
     */
    public function withDurationSeconds(float $durationSeconds): self
    {
        $self = clone $this;
        $self['durationSeconds'] = $durationSeconds;

        return $self;
    }

    /**
     * Output resolution tier (e.g. `SD`, `HD`, `4K`).
     */
    public function withResolution(string $resolution): self
    {
        $self = clone $this;
        $self['resolution'] = $resolution;

        return $self;
    }
}
